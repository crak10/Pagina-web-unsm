<?php
/**
 * Cargar WordPress
 * Integración de WordPress en la página de organigrama
 */
$wp_load_path = __DIR__ . '/../../wordpress/wp-load.php';
$wp_config_path = __DIR__ . '/../../wordpress/wp-config.php';
$wp_compat_path = __DIR__ . '/../../wordpress/wp-includes/compat.php';

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
    <meta name="description" content="Organigrama estructural de la Universidad Nacional de San Martín - UNSM. Estructura organizacional institucional.">
    <meta name="keywords" content="UNSM, organigrama, estructura organizacional, universidad nacional de san martín">
    <meta name="author" content="Universidad Nacional de San Martín">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#359444">

    <title>Organigrama - UNSM</title>

    <link rel="icon" type="image/png" href="../../imagenes/escudo unsm.png" sizes="48x48">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="css/styleOni.css">
</head>
<body>
    <header class="top-header" role="banner">
        <div class="top-header-content">
            <nav class="social-icons" aria-label="Redes sociales">
                <a href="https://www.facebook.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Facebook UNSM">
                    <img src="../../imagenes/redes/logo facebook.png" alt="Facebook" width="36" height="36">
                </a>
                <a href="https://www.instagram.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Instagram UNSM">
                    <img src="../../imagenes/redes/logo instagram.png" alt="Instagram" width="36" height="36">
                </a>
                <a href="https://youtube.com/@unsmperu" target="_blank" rel="noopener noreferrer" aria-label="YouTube UNSM">
                    <img src="../../imagenes/redes/logo yt.png" alt="YouTube" width="36" height="36">
                </a>
                <a href="https://x.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter) UNSM">
                    <img src="../../imagenes/redes/logo x.png" alt="X" width="36" height="36">
                </a>
                <a href="https://www.tiktok.com/@campus.unsm" target="_blank" rel="noopener noreferrer" aria-label="TikTok UNSM">
                    <img src="../../imagenes/redes/logo tiktok.png" alt="TikTok" width="36" height="36">
                </a>
            </nav>
            <div class="contact-info">
                <span>
                    <img src="../../imagenes/logo telefono.png" alt="Teléfono" class="contact-icon" width="18" height="18">
                    <span>(+51) (042) 48 0159</span>
                </span>
                <span>
                    <img src="../../imagenes/logo correo.png" alt="Correo" class="contact-icon" width="18" height="18">
                    <span>informes@unsm.edu.pe</span>
                </span>
            </div>
        </div>
    </header>

    <header class="main-header">
        <div class="main-header-content">
            <div class="logo">
                <a href="../../" aria-label="Ir a la página principal de UNSM">
                    <img src="../../imagenes/logo UNSM.png" alt="Logo de la Universidad Nacional de San Martín" width="auto" height="70">
                </a>
            </div>

            <button class="mobile-menu-toggle" aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="main-navigation">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>

            <nav class="main-nav" id="main-navigation" aria-label="Navegación principal">
                <div class="mobile-nav-logo">
                    <img src="../../imagenes/logo UNSM.png" alt="Logo UNSM" width="auto" height="65">
                </div>

                <ul class="nav-menu">
                    <li class="dropdown">
                        <a href="../../#nosotros" aria-haspopup="true" aria-expanded="false">NOSOTROS</a>
                        <ul class="dropdown-menu" aria-label="Menú Nosotros">
                            <li><a href="../autoridades/indexAuto.php">Autoridades</a></li>
                            <li><a href="../historia/historia.php">Historia de la Universidad</a></li>
                            <li><a href="../mision/indexMision.php">Nuestra Misión y Visión</a></li>
                            <li><a href="../objetivos/objeIndex.php">Objetivos</a></li>
                            <li><a href="./">Organigrama</a></li>
                            <li><a href="../himno/indexHimno.php">Himno</a></li>
                            <li><a href="../directorioInstucional/">Directorio Institucional</a></li>
                            <li><a href="../calendarioAcade/">Calendario Académico</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-wide">
                        <a href="../../#oficinas" aria-haspopup="true" aria-expanded="false">OFICINAS</a>
                        <ul class="dropdown-menu dropdown-columns" aria-label="Menú Oficinas">
                            <div class="dropdown-column">
                                <li class="dropdown-header">Oficinas Administrativas</li>
                                <li><a href="../../#rectorado">Rectorado</a></li>
                                <li><a href="../../#vicerrectorado-academico">Vicerrectorado Académico</a></li>
                                <li><a href="../../#vicerrectorado-investigacion">Vicerrectorado de Investigación</a></li>
                                <li><a href="../../#secretaria-general">Secretaría General</a></li>
                                <li><a href="../../#planeamiento">Planeamiento y Presupuesto</a></li>
                                <li><a href="../../#seguridad">Seguridad y Salud Ocupacional</a></li>
                                <li><a href="../../#comunicacion">Comunicación e Imagen Institucional</a></li>
                                <li><a href="../../#cooperacion">Cooperación y Relaciones Internacionales</a></li>
                                <li><a href="../../#control">Órgano de Control Institucional</a></li>
                                <li><a href="../../#ejecutora">Ejecutora de Inversiones</a></li>
                                <li><a href="../../#asesoria">Asesoría Jurídica</a></li>
                                <li><a href="../../#grados">Grados y Títulos</a></li>
                            </div>
                            <div class="dropdown-column">
                                <li class="dropdown-header">Oficinas Académicas</li>
                                <li><a href="../../#admision">Oficina de Admisión</a></li>
                                <li><a href="../../#asuntos-academicos">Asuntos Académicos</a></li>
                                <li><a href="../../#seguimiento">Seguimiento al Egresado e Inserción Laboral</a></li>
                                <li><a href="../../#tecnologias">Tecnologías de la Información</a></li>
                                <li><a href="../../#incubadora">Incubadora de Empresas</a></li>
                                <li><a href="../../#fondo-editorial">Fondo Editorial</a></li>
                                <li><a href="../../#comite-electoral">Comité Electoral Universitario</a></li>
                                <li><a href="../../#innovacion">Innovación y Transferencia Tecnológica</a></li>
                                <li><a href="../../#produccion">Producción de Bienes y Servicios</a></li>
                                <li><a href="../../#responsabilidad">Responsabilidad Social Universitaria</a></li>
                                <li><a href="../../#servicios-generales">Servicios Generales</a></li>
                                <li><a href="../../#bienestar">Bienestar Universitario</a></li>
                                <li><a href="../../#defensoria">Defensoría Universitaria</a></li>
                                <li><a href="../../#calidad">Gestión de la Calidad</a></li>
                            </div>
                        </ul>
                    </li>
                    <li><a href="../../#admision">ADMISIÓN</a></li>
                    <li><a href="../../#cpu">CPU</a></li>
                    <li class="dropdown dropdown-facultades">
                        <a href="../../#facultades" aria-haspopup="true" aria-expanded="false">FACULTADES</a>
                        <ul class="dropdown-menu" aria-label="Menú Facultades">
                            <li class="has-submenu">
                                <a href="../../#ciencias-agrarias" aria-haspopup="true" aria-expanded="false">Ciencias Agrarias</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Ciencias Agrarias">
                                    <li><a href="../../#agronomia">Agronomía</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#ciencias-salud" aria-haspopup="true" aria-expanded="false">Ciencias de la Salud</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Ciencias de la Salud">
                                    <li><a href="../../#obstetricia">Obstetricia</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#medicina-veterinaria" aria-haspopup="true" aria-expanded="false">Medicina Veterinaria</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Medicina Veterinaria">
                                    <li><a href="../../#medicina-veterinaria-carrera">Medicina Veterinaria</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#ingenieria-agroindustrial" aria-haspopup="true" aria-expanded="false">Ingeniería Agroindustrial</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Ingeniería Agroindustrial">
                                    <li><a href="../../#ing-agroindustrial">Ingeniería Agroindustrial</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#ingenieria-civil" aria-haspopup="true" aria-expanded="false">Ingeniería Civil y Arquitectura</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Ingeniería Civil y Arquitectura">
                                    <li><a href="../../#arquitectura">Arquitectura</a></li>
                                    <li><a href="../../#ingenieria-civil-carrera">Ingeniería Civil</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#ingenieria-sistemas" aria-haspopup="true" aria-expanded="false">Ingeniería de Sistemas e Informática</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Ingeniería de Sistemas">
                                    <li><a href="../../#ing-sistemas">Ingeniería de Sistemas e Informática</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#ecologia" aria-haspopup="true" aria-expanded="false">Ecología</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Ecología">
                                    <li><a href="../../#ing-ambiental">Ingeniería Ambiental</a></li>
                                    <li><a href="../../#ing-sanitaria">Ingeniería Sanitaria</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#derecho" aria-haspopup="true" aria-expanded="false">Derecho y Ciencias Políticas</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Derecho">
                                    <li><a href="../../#derecho-carrera">Derecho</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#medicina-humana" aria-haspopup="true" aria-expanded="false">Medicina Humana</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Medicina Humana">
                                    <li><a href="../../#medicina-humana-carrera">Medicina Humana</a></li>
                                    <li><a href="../../#enfermeria">Enfermería</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#ciencias-economicas" aria-haspopup="true" aria-expanded="false">Ciencias Económicas</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Ciencias Económicas">
                                    <li><a href="../../#administracion">Administración</a></li>
                                    <li><a href="../../#contabilidad">Contabilidad</a></li>
                                    <li><a href="../../#economia">Economía</a></li>
                                    <li><a href="../../#turismo">Turismo</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="../../#educacion" aria-haspopup="true" aria-expanded="false">Educación y Humanidades</a>
                                <ul class="submenu-carreras" aria-label="Carreras de Educación">
                                    <li><a href="../../#educacion-inicial">Educación Inicial</a></li>
                                    <li><a href="../../#educacion-primaria">Educación Primaria</a></li>
                                    <li><a href="../../#educacion-secundaria">Educación Secundaria</a></li>
                                    <li><a href="../../#idiomas">Idiomas</a></li>
                                    <li>
                                        <a href="../../#psicologia">
                                            Psicología
                                            <span class="badge-nuevo">Nuevo</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="../../#posgrado">POSGRADO</a></li>
                    <li class="dropdown">
                        <a href="../../#transparencia" aria-haspopup="true" aria-expanded="false">TRANSPARENCIA</a>
                        <ul class="dropdown-menu" aria-label="Menú Transparencia">
                            <li><a href="../../#licenciamiento">Licenciamiento</a></li>
                            <li><a href="../../#institucional">Institucional Ley 30220</a></li>
                            <li><a href="../../#estandar">Estándar Ley 27806</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="mobile-nav-gob-logos">
                    <a href="https://www.gob.pe/unsm" target="_blank" rel="noopener noreferrer" aria-label="Portal de Transparencia UNSM">
                        <img src="../../imagenes/logo portal de trans.png" alt="Portal de Transparencia" width="auto" height="35">
                    </a>
                    <a href="https://www.gob.pe" target="_blank" rel="noopener noreferrer" aria-label="Gobierno del Perú">
                        <img src="../../imagenes/logo gobPe.png" alt="Gobierno del Perú" width="auto" height="35">
                    </a>
                </div>
            </nav>

            <div class="gob-logos">
                <a href="https://www.gob.pe/unsm" target="_blank" rel="noopener noreferrer" aria-label="Portal de Transparencia">
                    <img src="../../imagenes/logo portal de trans.png" alt="Portal de Transparencia" class="portal-trans-logo" width="auto" height="32">
                </a>
                <a href="https://www.gob.pe" target="_blank" rel="noopener noreferrer" aria-label="Gobierno del Perú">
                    <img src="../../imagenes/logo gobPe.png" alt="Gobierno del Perú" class="gob-logo" width="auto" height="30">
                </a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="organigrama-hero">
            <div class="organigrama-hero-content">
                <h1>ORGANIGRAMA</h1>
                <div class="organigrama-hero-subtitle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                        <path d="M9 11l3 3L22 4"></path>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <span>Nuestro organigrama estructural.</span>
                </div>
            </div>
        </section>

        <!-- Organigrama Section -->
        <section class="organigrama-section">
            <div class="organigrama-container">
                <div class="organigrama-image-wrapper">
                    <img src="imagenes/Onigrama.jpg" alt="Organigrama de la Universidad Nacional de San Martín" class="organigrama-image" loading="lazy">
                </div>
            </div>
        </section>
    </main>

    <footer role="contentinfo">
        <div class="footer-content">
            <section class="footer-section">
                <div class="footer-logo-section">
                    <img src="../../imagenes/escudo unsm.png" alt="Escudo oficial de la UNSM" class="footer-logo" width="60" height="auto">
                    <h3 class="footer-title">UNSM</h3>
                </div>
                <p class="footer-description">
                    Centro Superior de Estudios autónomo y de carácter estatal, comprometido con la formación de profesionales humanistas y competitivos, con responsabilidad social y comprometidos con el desarrollo local, regional y nacional.
                </p>
                <address>
                    <p>Jr. Maynas N° 177 - Morales</p>
                    <p>Tarapoto - San Martín - Perú</p>
                    <p>Central Telefónica: <span>(+51) (042) 48 0159</span></p>
                    <p>Email: <span>informes@unsm.edu.pe</span></p>
                </address>
            </section>

            <nav class="footer-section" aria-labelledby="footer-links-title">
                <h3 id="footer-links-title" class="footer-title">Enlaces Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="../../#admision">Admisión</a></li>
                    <li><a href="../../#facultades">Facultades</a></li>
                    <li><a href="../../#posgrado">Posgrado</a></li>
                    <li><a href="../../#investigacion">Investigación</a></li>
                </ul>
            </nav>

            <nav class="footer-section" aria-labelledby="footer-services-title">
                <h3 id="footer-services-title" class="footer-title">Servicios</h3>
                <ul class="footer-links">
                    <li><a href="../../#biblioteca">Biblioteca Virtual</a></li>
                    <li><a href="../../#campus-virtual">Campus Virtual</a></li>
                    <li><a href="../../#repositorio">Repositorio Institucional</a></li>
                    <li><a href="../../#transparencia">Portal de Transparencia</a></li>
                    <li><a href="../../#libro-reclamaciones">Libro de Reclamaciones</a></li>
                    <li><a href="../../contacto/indexContac.php">Enviar Mensaje</a></li>
                </ul>
            </nav>

            <section class="footer-section footer-facebook" aria-labelledby="footer-facebook-title">
                <h3 id="footer-facebook-title" class="footer-title">Facebook UNSM</h3>
                <div class="fb-page"
                    data-href="https://www.facebook.com/unsmperu"
                    data-tabs="timeline"
                    data-width="320"
                    data-height="320"
                    data-small-header="false"
                    data-adapt-container-width="true"
                    data-hide-cover="false"
                    data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/unsmperu" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/unsmperu">Universidad Nacional de San Martín - UNSM</a>
                    </blockquote>
                </div>
            </section>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; 2025 Universidad Nacional de San Martín. Todos los derechos reservados.</p>
                <div class="footer-social-bottom">
                    <span class="footer-social-title">Síguenos</span>
                    <nav class="footer-social" aria-label="Redes sociales de la UNSM">
                        <a href="https://www.facebook.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Facebook UNSM">
                            <img src="../../imagenes/redes/logo facebook.png" alt="Facebook" width="22" height="22">
                        </a>
                        <a href="https://www.instagram.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Instagram UNSM">
                            <img src="../../imagenes/redes/logo instagram.png" alt="Instagram" width="22" height="22">
                        </a>
                        <a href="https://youtube.com/@unsmperu" target="_blank" rel="noopener noreferrer" aria-label="YouTube UNSM">
                            <img src="../../imagenes/redes/logo yt.png" alt="YouTube" width="22" height="22">
                        </a>
                        <a href="https://x.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter) UNSM">
                            <img src="../../imagenes/redes/logo x.png" alt="X" width="22" height="22">
                        </a>
                        <a href="https://www.tiktok.com/@campus.unsm" target="_blank" rel="noopener noreferrer" aria-label="TikTok UNSM">
                            <img src="../../imagenes/redes/logo tiktok.png" alt="TikTok" width="22" height="22">
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <script src="../../js/script.js" defer></script>
    <script src="js/scriptOni.js" defer></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v18.0"></script>
</body>
</html>

