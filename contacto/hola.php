<?php
/**
 * Cargar WordPress
 * Integración de WordPress en el archivo de prueba
 */
$wp_load_path = __DIR__ . '/../wordpress/wp-load.php';
$wp_config_path = __DIR__ . '/../wordpress/wp-config.php';
$wp_compat_path = __DIR__ . '/../wordpress/wp-includes/compat.php';

// Verificar si WordPress está instalado y configurado antes de cargar
if (file_exists($wp_load_path) && file_exists($wp_config_path) && file_exists($wp_compat_path)) {
    require_once($wp_load_path);
}

echo "<h1>FUNCIONA!</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Este archivo esta en: " . __FILE__ . "</p>";
?>