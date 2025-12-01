<?php
/**
 * PRUEBA RÁPIDA PARA XAMPP
 * Guarda este archivo como: C:\xampp\htdocs\contacto\test_xampp.php
 */

/**
 * Cargar WordPress
 * Integración de WordPress en el archivo de prueba XAMPP
 */
$wp_load_path = __DIR__ . '/../wordpress/wp-load.php';
$wp_config_path = __DIR__ . '/../wordpress/wp-config.php';
$wp_compat_path = __DIR__ . '/../wordpress/wp-includes/compat.php';

// Verificar si WordPress está instalado y configurado antes de cargar
if (file_exists($wp_load_path) && file_exists($wp_config_path) && file_exists($wp_compat_path)) {
    require_once($wp_load_path);
}

echo "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Prueba XAMPP - UNSM</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .success { background: #d4edda; border: 2px solid #28a745; padding: 20px; border-radius: 8px; margin: 10px 0; }
        .error { background: #f8d7da; border: 2px solid #dc3545; padding: 20px; border-radius: 8px; margin: 10px 0; }
        .info { background: #d1ecf1; border: 2px solid #0c5460; padding: 20px; border-radius: 8px; margin: 10px 0; }
        h1 { color: #359444; }
        ul { line-height: 2; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>🔍 Diagnóstico XAMPP - Sistema de Contacto UNSM</h1>
    <hr>
";

// 1. Verificar PHP
echo "<div class='success'>";
echo "<h2>✅ 1. PHP está funcionando</h2>";
echo "<p><strong>Versión:</strong> " . phpversion() . "</p>";
echo "</div>";

// 2. Verificar ubicación
echo "<div class='info'>";
echo "<h2>📍 2. Ubicación de este archivo</h2>";
echo "<p><strong>Ruta completa:</strong> " . __FILE__ . "</p>";
echo "<p><strong>Directorio:</strong> " . __DIR__ . "</p>";
echo "</div>";

// 3. Listar archivos en la carpeta actual
echo "<div class='info'>";
echo "<h2>📁 3. Archivos en esta carpeta</h2>";
echo "<ul>";
$files = scandir(__DIR__);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        $icon = is_dir(__DIR__ . '/' . $file) ? '📁' : '📄';
        echo "<li>$icon $file</li>";
    }
}
echo "</ul>";
echo "</div>";

// 4. Verificar carpeta config
if (is_dir(__DIR__ . '/config')) {
    echo "<div class='success'>";
    echo "<h2>✅ 4. Carpeta 'config' encontrada</h2>";
    
    // Verificar db_config.php
    if (file_exists(__DIR__ . '/config/db_config.php')) {
        echo "<p>✅ Archivo <code>config/db_config.php</code> existe</p>";
        
        // Intentar incluir el archivo
        try {
            require_once __DIR__ . '/config/db_config.php';
            echo "<p>✅ Archivo <code>db_config.php</code> se carga correctamente</p>";
            
            // Mostrar configuración
            echo "<p><strong>Configuración de BD:</strong></p>";
            echo "<ul>";
            echo "<li>Servidor: <code>" . DB_HOST . "</code></li>";
            echo "<li>Base de datos: <code>" . DB_NAME . "</code></li>";
            echo "<li>Usuario: <code>" . DB_USER . "</code></li>";
            echo "<li>Contraseña: " . (DB_PASS == '' ? '<code>(vacía)</code> ✅' : '<code>(configurada)</code>') . "</li>";
            echo "</ul>";
        } catch (Exception $e) {
            echo "<p>❌ Error al cargar <code>db_config.php</code>: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>❌ Archivo <code>config/db_config.php</code> NO encontrado</p>";
    }
    echo "</div>";
} else {
    echo "<div class='error'>";
    echo "<h2>❌ 4. Carpeta 'config' NO encontrada</h2>";
    echo "<p><strong>Solución:</strong></p>";
    echo "<ol>";
    echo "<li>Crea una carpeta llamada <code>config</code> en: " . __DIR__ . "</li>";
    echo "<li>Coloca el archivo <code>db_config.php</code> dentro de ella</li>";
    echo "</ol>";
    echo "</div>";
}

// 5. Verificar extensión MySQLi
echo "<div class='" . (extension_loaded('mysqli') ? 'success' : 'error') . "'>";
echo "<h2>" . (extension_loaded('mysqli') ? '✅' : '❌') . " 5. Extensión MySQLi</h2>";
if (extension_loaded('mysqli')) {
    echo "<p>La extensión MySQLi está instalada y activa</p>";
} else {
    echo "<p><strong>ERROR:</strong> La extensión MySQLi NO está instalada</p>";
    echo "<p><strong>Solución:</strong></p>";
    echo "<ol>";
    echo "<li>Abre el archivo: <code>C:\\xampp\\php\\php.ini</code></li>";
    echo "<li>Busca la línea: <code>;extension=mysqli</code></li>";
    echo "<li>Quita el punto y coma: <code>extension=mysqli</code></li>";
    echo "<li>Guarda el archivo</li>";
    echo "<li>Reinicia Apache desde el Panel de Control de XAMPP</li>";
    echo "</ol>";
}
echo "</div>";

// 6. Intentar conexión a MySQL
if (extension_loaded('mysqli') && defined('DB_HOST')) {
    echo "<div class='info'>";
    echo "<h2>🔌 6. Probando conexión a MySQL</h2>";
    
    try {
        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            throw new Exception($conn->connect_error);
        }
        
        echo "<div class='success'>";
        echo "<h3>✅ Conexión exitosa a MySQL</h3>";
        echo "<p>La conexión a la base de datos funciona correctamente</p>";
        echo "</div>";
        
        // Verificar tabla
        $result = @$conn->query("SHOW TABLES LIKE 'mensajes_contacto'");
        if ($result && $result->num_rows > 0) {
            echo "<p>✅ Tabla <code>mensajes_contacto</code> existe</p>";
            
            // Contar registros
            $result = $conn->query("SELECT COUNT(*) as total FROM mensajes_contacto");
            $row = $result->fetch_assoc();
            echo "<p>📊 Total de mensajes: <strong>" . $row['total'] . "</strong></p>";
        } else {
            echo "<div class='error'>";
            echo "<p>❌ Tabla <code>mensajes_contacto</code> NO existe</p>";
            echo "<p><strong>Solución:</strong> Importa el archivo <code>database_contacto.sql</code> en phpMyAdmin</p>";
            echo "</div>";
        }
        
        $conn->close();
        
    } catch (Exception $e) {
        echo "<div class='error'>";
        echo "<h3>❌ Error de conexión a MySQL</h3>";
        echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>Soluciones:</strong></p>";
        echo "<ol>";
        echo "<li>Verifica que MySQL esté corriendo en el Panel de Control de XAMPP (debe estar en VERDE)</li>";
        echo "<li>Verifica las credenciales en <code>config/db_config.php</code></li>";
        echo "<li>Verifica que la base de datos <code>unsm_contacto</code> exista en phpMyAdmin</li>";
        echo "<li>Si usas XAMPP en Windows, el usuario es <code>root</code> y la contraseña está vacía</li>";
        echo "</ol>";
        echo "</div>";
    }
    echo "</div>";
}

// 7. URLs importantes
echo "<div class='info'>";
echo "<h2>🌐 7. URLs para acceder</h2>";
echo "<ul>";
echo "<li><strong>Esta página:</strong> <code>http://localhost/contacto/test_xampp.php</code></li>";
echo "<li><strong>Formulario:</strong> <code>http://localhost/contacto/indexContac.php</code></li>";
echo "<li><strong>Admin:</strong> <code>http://localhost/contacto/adminMensajes.php</code></li>";
echo "<li><strong>phpMyAdmin:</strong> <code>http://localhost/phpmyadmin</code></li>";
echo "</ul>";
echo "</div>";

// 8. Siguiente paso
echo "<div class='success'>";
echo "<h2>🎯 Siguiente paso</h2>";
echo "<p>Si todos los tests anteriores pasaron ✅, intenta acceder al formulario:</p>";
echo "<p><a href='indexContac.php' style='background: #359444; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;'>Ir al Formulario de Contacto</a></p>";
echo "</div>";

echo "</body></html>";
?>