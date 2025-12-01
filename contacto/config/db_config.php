<?php
/**
 * =====================================================
 * CONFIGURACIÓN DE CONEXIÓN A BASE DE DATOS - UNSM
 * Archivo: config/db_config.php
 * =====================================================
 */

// Configuración de la base de datos
define('DB_HOST', 'localhost');           // Servidor de base de datos
define('DB_NAME', 'unsm_contacto');       // Nombre de la base de datos
define('DB_USER', 'root');                // Usuario de la base de datos
define('DB_PASS', '');                    // Contraseña (vacía en local)
define('DB_CHARSET', 'utf8mb4');          // Codificación de caracteres

/**
 * =====================================================
 * INSTRUCCIONES PARA CONFIGURAR
 * =====================================================
 * 
 * PARA SERVIDOR LOCAL (XAMPP/WAMP/LARAGON):
 * - DB_HOST: 'localhost'
 * - DB_USER: 'root'
 * - DB_PASS: '' (dejar vacío)
 * 
 * PARA SERVIDOR EN PRODUCCIÓN:
 * - Cambia DB_HOST por la dirección de tu servidor
 * - Cambia DB_USER por el usuario proporcionado por tu hosting
 * - Cambia DB_PASS por la contraseña proporcionada por tu hosting
 * - DB_NAME debe ser el nombre de la base de datos que creaste
 * 
 * EJEMPLO PARA HOSTING:
 * define('DB_HOST', 'mysql.tudominio.com');
 * define('DB_USER', 'usuario_unsm');
 * define('DB_PASS', 'tu_contraseña_segura');
 * define('DB_NAME', 'unsm_contacto');
 * 
 * =====================================================
 */

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Configuración de errores (cambiar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1); // Cambiar a 0 en producción

/**
 * Función para crear conexión a la base de datos
 * @return mysqli Objeto de conexión
 * @throws Exception Si no se puede conectar
 */
function getDBConnection() {
    try {
        // Crear conexión
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        // Verificar conexión
        if ($conn->connect_error) {
            throw new Exception("Error de conexión: " . $conn->connect_error);
        }
        
        // Establecer charset
        if (!$conn->set_charset(DB_CHARSET)) {
            throw new Exception("Error estableciendo charset: " . $conn->error);
        }
        
        return $conn;
        
    } catch (Exception $e) {
        // Log del error (opcional)
        error_log("Error de conexión BD: " . $e->getMessage());
        
        // En producción, mostrar mensaje genérico
        if (ini_get('display_errors') == 0) {
            die("Error al conectar con la base de datos. Por favor, contacte al administrador.");
        } else {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}

/**
 * Función para cerrar conexión
 * @param mysqli $conn Objeto de conexión
 */
function closeDBConnection($conn) {
    if ($conn && !$conn->connect_error) {
        $conn->close();
    }
}

/**
 * Función para sanitizar entrada de datos
 * @param string $data Dato a sanitizar
 * @return string Dato sanitizado
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Función para validar email
 * @param string $email Email a validar
 * @return bool True si es válido
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Función para validar DNI peruano
 * @param string $dni DNI a validar
 * @return bool True si es válido
 */
function validateDNI($dni) {
    // DNI peruano: 8 dígitos
    return preg_match('/^[0-9]{8}$/', $dni);
}

/**
 * Función para validar teléfono peruano
 * @param string $telefono Teléfono a validar
 * @return bool True si es válido
 */
function validateTelefono($telefono) {
    // Teléfono peruano: 9 dígitos empezando con 9
    $telefono = preg_replace('/[^0-9]/', '', $telefono);
    return preg_match('/^9[0-9]{8}$/', $telefono);
}
?>