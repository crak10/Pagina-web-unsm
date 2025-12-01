<?php
/**
 * =====================================================
 * PROCESADOR DE FORMULARIO - VERSIÓN CORREGIDA
 * procesarContacto.php (sin guion bajo)
 * =====================================================
 */

/**
 * Cargar WordPress
 * Integración de WordPress en el procesador de contacto
 */
$wp_load_path = __DIR__ . '/../wordpress/wp-load.php';
$wp_config_path = __DIR__ . '/../wordpress/wp-config.php';
$wp_compat_path = __DIR__ . '/../wordpress/wp-includes/compat.php';

// Verificar si WordPress está instalado y configurado antes de cargar
if (file_exists($wp_load_path) && file_exists($wp_config_path) && file_exists($wp_compat_path)) {
    require_once($wp_load_path);
}

// IMPORTANTE: No debe haber NADA antes de esta línea (ni espacios, ni BOM)

// Deshabilitar output buffering para evitar problemas
ob_start();

// Configurar headers PRIMERO (antes de cualquier output)
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Iniciar sesión
session_start();

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
    exit;
}

try {
    // Incluir archivo de configuración
    if (!file_exists('config/db_config.php')) {
        throw new Exception('No se encuentra el archivo de configuración config/db_config.php');
    }
    
    require_once 'config/db_config.php';
    
    // Obtener y validar datos del formulario
    $nombre = isset($_POST['nombre']) ? sanitizeInput($_POST['nombre']) : '';
    $dni = isset($_POST['dni']) ? sanitizeInput($_POST['dni']) : '';
    $telefono = isset($_POST['telefono']) ? sanitizeInput($_POST['telefono']) : '';
    $correo = isset($_POST['correo']) ? sanitizeInput($_POST['correo']) : '';
    $oficina = isset($_POST['oficina']) ? sanitizeInput($_POST['oficina']) : '';
    $mensaje = isset($_POST['mensaje']) ? sanitizeInput($_POST['mensaje']) : '';
    
    // Array para errores de validación
    $errores = [];
    
    // Validar campos obligatorios
    if (empty($nombre)) {
        $errores[] = 'El nombre es obligatorio';
    } elseif (strlen($nombre) < 3) {
        $errores[] = 'El nombre debe tener al menos 3 caracteres';
    }
    
    if (empty($dni)) {
        $errores[] = 'El DNI es obligatorio';
    } elseif (!validateDNI($dni)) {
        $errores[] = 'El DNI debe tener 8 dígitos';
    }
    
    if (empty($telefono)) {
        $errores[] = 'El teléfono es obligatorio';
    } elseif (!validateTelefono($telefono)) {
        $errores[] = 'El teléfono debe ser un número peruano válido (9 dígitos empezando con 9)';
    }
    
    if (empty($correo)) {
        $errores[] = 'El correo electrónico es obligatorio';
    } elseif (!validateEmail($correo)) {
        $errores[] = 'El correo electrónico no es válido';
    }
    
    if (empty($oficina)) {
        $errores[] = 'Debe seleccionar una oficina';
    }
    
    if (empty($mensaje)) {
        $errores[] = 'El mensaje es obligatorio';
    } elseif (strlen($mensaje) < 10) {
        $errores[] = 'El mensaje debe tener al menos 10 caracteres';
    }
    
    // Si hay errores de validación, retornarlos
    if (!empty($errores)) {
        http_response_code(400);
        ob_clean(); // Limpiar cualquier output previo
        echo json_encode([
            'success' => false,
            'message' => 'Errores de validación',
            'errores' => $errores
        ]);
        exit;
    }
    
    // Obtener información adicional
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    
    // Conectar a la base de datos
    $conn = getDBConnection();
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO mensajes_contacto 
            (nombre, dni, telefono, correo, oficina, mensaje, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }
    
    // Vincular parámetros
    $stmt->bind_param(
        "ssssssss", 
        $nombre, 
        $dni, 
        $telefono, 
        $correo, 
        $oficina, 
        $mensaje, 
        $ip_address, 
        $user_agent
    );
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        $mensaje_id = $stmt->insert_id;
        
        // Cerrar statement y conexión
        $stmt->close();
        closeDBConnection($conn);
        
        // Respuesta exitosa
        http_response_code(200);
        ob_clean(); // Limpiar cualquier output previo
        echo json_encode([
            'success' => true,
            'message' => 'Tu mensaje ha sido enviado exitosamente. Gracias por contactarte con la UNSM.',
            'mensaje_id' => $mensaje_id
        ]);
        
    } else {
        throw new Exception("Error al guardar el mensaje: " . $stmt->error);
    }
    
} catch (Exception $e) {
    // Log del error
    error_log("Error en procesarContacto.php: " . $e->getMessage());
    
    // Respuesta de error
    http_response_code(500);
    ob_clean(); // Limpiar cualquier output previo
    echo json_encode([
        'success' => false,
        'message' => 'Error al procesar el formulario. Por favor, inténtalo nuevamente.',
        'error' => $e->getMessage()
    ]);
}

// Finalizar y enviar el output
ob_end_flush();
?>