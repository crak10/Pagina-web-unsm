<?php
/**
 * Cargar WordPress
 * Integración de WordPress en la página base
 */
$wp_load_path = __DIR__ . '/../wordpress/wp-load.php';
$wp_config_path = __DIR__ . '/../wordpress/wp-config.php';
$wp_compat_path = __DIR__ . '/../wordpress/wp-includes/compat.php';

// Verificar si WordPress está instalado y configurado antes de cargar
if (file_exists($wp_load_path) && file_exists($wp_config_path) && file_exists($wp_compat_path)) {
    require_once($wp_load_path);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Universidad Nacional de San Martín - UNSM en Tarapoto, Perú. 11 facultades con programas acreditados, admisión 2025, posgrado e investigación de excelencia en la Amazonía.">
    <meta name="keywords" content="UNSM, Universidad San Martín, educación superior Tarapoto, universidad Perú, admisión universidad, facultades UNSM, posgrado Tarapoto">
    <meta name="author" content="Universidad Nacional de San Martín">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#359444">
    
    <title>Universidad Nacional de San Martín - UNSM | Admisión 2025</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="imagenes/escudo unsm.png" sizes="48x48">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="styleBase.css">
</head>
<body>
    <!-- Header Superior -->
    <header class="top-header">
        <div class="top-header-container">
            <!-- Redes Sociales -->
            <div class="social-media">
                <a href="https://www.facebook.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Facebook UNSM">
                    <img src="imagenes/redes/logo facebook.png" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Instagram UNSM">
                    <img src="imagenes/redes/logo instagram.png" alt="Instagram">
                </a>
                <a href="https://youtube.com/@unsmperu" target="_blank" rel="noopener noreferrer" aria-label="YouTube UNSM">
                    <img src="imagenes/redes/logo yt.png" alt="YouTube">
                </a>
                <a href="https://x.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="X UNSM">
                    <img src="imagenes/redes/logo x.png" alt="X">
                </a>
                <a href="https://www.tiktok.com/@campus.unsm" target="_blank" rel="noopener noreferrer" aria-label="TikTok UNSM">
                    <img src="imagenes/redes/logo tiktok.png" alt="TikTok">
                </a>
            </div>

            <!-- Información de Contacto -->
            <div class="header-contact">
                <div class="contact-item">
                    <img src="imagenes/logo telefono.png" alt="Teléfono" class="contact-icon">
                    <span>(+51) (042) 48 0159</span>
                </div>
                <div class="contact-item">
                    <img src="imagenes/logo correo.png" alt="Email" class="contact-icon">
                    <span>informes@unsm.edu.pe</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Header Principal con Navegación -->
    <header class="main-header">
        <div class="main-header-container">
            <!-- Logo -->
            <div class="logo">
                <a href="/">
                    <img src="imagenes/logo UNSM.png" alt="Universidad Nacional de San Martín">
                </a>
            </div>

            <!-- Navegación Desktop -->
            <nav class="main-nav">
                <ul class="nav-menu">
                    <li><a href="#nosotros">NOSOTROS</a></li>
                    <li><a href="#oficinas">OFICINAS</a></li>
                    <li><a href="#admision">ADMISIÓN</a></li>
                    <li><a href="#cpu">CPU</a></li>
                    <li><a href="#facultades">FACULTADES</a></li>
                    <li><a href="#posgrado">POSGRADO</a></li>
                    <li><a href="#transparencia">TRANSPARENCIA</a></li>
                </ul>
            </nav>

            <!-- Logos Institucionales -->
            <div class="institutional-logos">
                <a href="https://www.gob.pe/unsm" target="_blank" rel="noopener noreferrer">
                    <img src="imagenes/logo portal de trans.png" alt="Portal de Transparencia" class="logo-transparencia">
                </a>
                <a href="https://www.gob.pe" target="_blank" rel="noopener noreferrer">
                    <img src="imagenes/logo gobPe.png" alt="Gobierno del Perú" class="logo-gob">
                </a>
            </div>

            <!-- Botón menú móvil -->
            <button class="mobile-menu-btn" aria-label="Menú">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Universidad Nacional de San Martín</h1>
                <p>Excelencia Académica en la Amazonía Peruana</p>
                <button class="btn-primary">INSCRÍBETE AQUÍ</button>
            </div>
        </section>

        <!-- Secciones del sitio van aquí -->
        <section class="content-section">
            <div class="container">
                <h2>Bienvenidos a la UNSM</h2>
                <p>Contenido de ejemplo...</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-container">
            <!-- Columna 1: Información UNSM -->
            <div class="footer-column footer-info">
                <div class="footer-logo">
                    <img src="imagenes/escudo unsm.png" alt="Escudo UNSM">
                    <h3>UNSM</h3>
                </div>
                <p class="footer-description">
                    Centro Superior de Estudios autónomo y de carácter estatal, comprometido con la formación de profesionales humanistas y competitivos, con responsabilidad social y comprometidos con el desarrollo local, regional y nacional.
                </p>
                <div class="footer-address">
                    <p><strong>Jr. Maynas N° 177 - Morales</strong></p>
                    <p>Tarapoto - San Martín - Perú</p>
                    <p><strong>Central Telefónica:</strong> (+51) (042) 48 0159</p>
                    <p><strong>Email:</strong> informes@unsm.edu.pe</p>
                </div>
            </div>

            <!-- Columna 2: Enlaces Rápidos -->
            <div class="footer-column">
                <h4>Enlaces Rápidos</h4>
                <ul class="footer-links">
                    <li><a href="#admision">Admisión</a></li>
                    <li><a href="#facultades">Facultades</a></li>
                    <li><a href="#posgrado">Posgrado</a></li>
                    <li><a href="#investigacion">Investigación</a></li>
                </ul>
            </div>

            <!-- Columna 3: Servicios -->
            <div class="footer-column">
                <h4>Servicios</h4>
                <ul class="footer-links">
                    <li><a href="#biblioteca">Biblioteca Virtual</a></li>
                    <li><a href="#campus">Campus Virtual</a></li>
                    <li><a href="#repositorio">Repositorio Institucional</a></li>
                    <li><a href="#transparencia">Portal de Transparencia</a></li>
                    <li><a href="#reclamaciones">Libro de Reclamaciones</a></li>
                    <li><a href="contacto/indexContac.php">Enviar Mensaje</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <p class="copyright">© 2025 Universidad Nacional de San Martín. Todos los derechos reservados.</p>
                
                <div class="footer-social">
                    <span class="social-title">Síguenos</span>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <img src="imagenes/redes/logo facebook.png" alt="Facebook">
                        </a>
                        <a href="https://www.instagram.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <img src="imagenes/redes/logo instagram.png" alt="Instagram">
                        </a>
                        <a href="https://youtube.com/@unsmperu" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                            <img src="imagenes/redes/logo yt.png" alt="YouTube">
                        </a>
                        <a href="https://x.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="X">
                            <img src="imagenes/redes/logo x.png" alt="X">
                        </a>
                        <a href="https://www.tiktok.com/@campus.unsm" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                            <img src="imagenes/redes/logo tiktok.png" alt="TikTok">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/script-v2.js"></script>
</body>
</html>