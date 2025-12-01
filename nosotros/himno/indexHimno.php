<?php
/**
 * Cargar WordPress
 * Integración de WordPress en la página de himno
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
    <meta name="description" content="Himno institucional de la Universidad Nacional de San Martín - UNSM en Tarapoto, Perú.">
    <meta name="keywords" content="UNSM, himno, universidad San Martín, himno institucional, educación superior Tarapoto">
    <meta name="author" content="Universidad Nacional de San Martín">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#359444">
    
    <title>Himno Institucional - Universidad Nacional de San Martín</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../imagenes/escudo unsm.png" sizes="48x48">
    <link rel="apple-touch-icon" href="../../imagenes/escudo unsm.png">
    
    <!-- Stylesheet Principal -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- Stylesheet Himno -->
    <link rel="stylesheet" href="css/styleHim.css">
</head>
<body>
    <!-- Header Superior -->
    <header class="top-header" role="banner">
        <div class="top-header-content">
            <nav class="social-icons" aria-label="Redes sociales">
                <a href="https://www.facebook.com/unsmperu" target="_blank" rel="noopener noreferrer" title="Síguenos en Facebook" aria-label="Página oficial de Facebook de la UNSM">
                    <img src="../../imagenes/redes/logo facebook.png" alt="Facebook" width="36" height="36">
                </a>
                <a href="https://www.instagram.com/unsmperu?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" title="Síguenos en Instagram" aria-label="Perfil oficial de Instagram de la UNSM">
                    <img src="../../imagenes/redes/logo instagram.png" alt="Instagram" width="36" height="36">
                </a>
                <a href="https://youtube.com/@unsmperu?si=Lu9kVK7VlDX3qkj6" target="_blank" rel="noopener noreferrer" title="Visita nuestro canal de YouTube" aria-label="Canal oficial de YouTube de la UNSM">
                    <img src="../../imagenes/redes/logo yt.png" alt="YouTube" width="36" height="36">
                </a>
                <a href="https://x.com/unsmperu" target="_blank" rel="noopener noreferrer" title="Síguenos en X (Twitter)" aria-label="Cuenta oficial de X de la UNSM">
                    <img src="../../imagenes/redes/logo x.png" alt="X (Twitter)" width="36" height="36">
                </a>
                <a href="https://www.tiktok.com/@campus.unsm?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer" title="Síguenos en TikTok" aria-label="Perfil oficial de TikTok de la UNSM">
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

    <!-- Header Principal -->
    <header class="main-header">
        <div class="main-header-content">
            <div class="logo">
                <a href="../../" aria-label="Ir a la página principal de UNSM">
                    <img src="../../imagenes/logo UNSM.png" alt="Logo de la Universidad Nacional de San Martín" width="auto" height="70">
                </a>
            </div>

            <!-- Botón Hamburguesa para móvil -->
            <button class="mobile-menu-toggle" aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="main-navigation">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>
            
            <nav class="main-nav" id="main-navigation" aria-label="Navegación principal">
                
                <!-- Logo en menú móvil -->
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
                            <li><a href="../onigrama/indexOni.php">Organigrama</a></li>
                            <li><a href="./">Himno</a></li>
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
                
                <!-- Logos gob.pe dentro del menú móvil -->
                <div class="mobile-nav-gob-logos">
                    <a href="https://www.gob.pe/unsm" target="_blank" rel="noopener noreferrer" aria-label="Portal de Transparencia de la UNSM">
                        <img src="../../imagenes/logo portal de trans.png" alt="Portal de Transparencia" width="auto" height="35">
                    </a>
                    <a href="https://www.gob.pe" target="_blank" rel="noopener noreferrer" aria-label="Portal del Gobierno del Perú">
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

    <!-- Contenido Principal -->
    <main id="main-content">
        <!-- Banner Verde Institucional -->
        <section class="himno-banner">
            <div class="himno-banner-content">
                <div class="himno-banner-left">
                    <h1>HIMNO</h1>
                    <div class="himno-banner-lines">
                        <div class="line-thick"></div>
                        <div class="line-thin"></div>
                    </div>
                </div>
                <div class="himno-banner-right">
                    <span class="himno-icon">♪</span>
                    <p>Nuestro himno institucional.</p>
                </div>
            </div>
        </section>

        <!-- Sección del Himno -->
        <section class="himno-section">
            <div class="himno-container">
                <div class="himno-escudo">
                    <img src="../../imagenes/escudo unsm.png" alt="Escudo Universidad Nacional de San Martín" loading="lazy">
                </div>
                
                <h2 class="himno-title">Himno de la Universidad Nacional de San Martín</h2>
                
                <div class="himno-content">
                    <div class="himno-stanza">
                        <p>Bajo el cielo tropical de la selva se levanta un templo del saber,</p>
                        <p>que con brazos abiertos espera,</p>
                        <p>a quien ingresa a sus aulas a aprender.</p>
                        <p>Aquí se forjan profesionales del mañana y se preparan para el trabajo y la vida vencer.</p>
                        <p>Prados, valles y montañas con sabiduría haremos florecer.</p>
                    </div>

                    <div class="himno-coro">
                        <p class="coro-label">CORO</p>
                        <p>¡Gloria a ti! ¡Gloria a ti!</p>
                        <p>Universidad Nacional de San Martín,</p>
                        <p>en el presente, eres ejemplo de cultura, ciencia y bienestar.</p>
                        <p>¡Gloria a ti! ¡Gloria a ti!</p>
                        <p>Universidad Nacional de San Martín;</p>
                        <p>te llevo siempre, aquí en mi alma, glorioso templo del saber.</p>
                    </div>

                    <div class="himno-stanza">
                        <p>Trabajadores, profesores y estudiantes todos unidos tu nombre elogiarán,</p>
                        <p>y adondequiera que me lleve el destino</p>
                        <p>U. San Martín gritará mi corazón.</p>
                        <p>Desde el oriente para el Perú</p>
                        <p>Y el mundo entero hombres capaces</p>
                        <p>De tus aulas saldrán.</p>
                        <p>Demostraremos que somos los primeros en todo campo en bien de la humanidad.</p>
                    </div>

                    <div class="himno-credits">
                        <p><strong>Letra y música:</strong> Jaime García Rengifo y Leonardo Leo Mendoza</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer role="contentinfo">
        <div class="footer-content">
            <section class="footer-section">
                <div class="footer-logo-section">
                    <img src="../../imagenes/escudo unsm.png" alt="Escudo oficial de la UNSM" class="footer-logo" width="60" height="auto">
                    <h3 class="footer-title">UNSM</h3>
                </div>
                <p class="footer-description">
                    Centro Superior de Estudios autónomo y de carácter estatal, comprometido con la formación de profesionales humanistas y competitivos, con responsabilidad social y comprometidos con el desarrollo local, regional y nacional, mediante la generación de conocimientos, tecnologías e innovación, en el marco de una cultura de valores, en proceso de acreditación y de actualización permanente.
                </p>
                <address>
                    <p><strong>Campus principal</strong></p>
                    <p>
                        <img src="../../imagenes/logo telefono.png" alt="Ubicación" width="16" height="16">
                        Jr. Maynas N° 177, Tarapoto - Perú
                    </p>
                    <p>
                        <img src="../../imagenes/logo telefono.png" alt="Teléfono" width="16" height="16">
                        (51-42)-52-4253
                    </p>
                    <p>
                        <img src="../../imagenes/logo correo.png" alt="Correo" width="16" height="16">
                        informes@unsm.edu.pe
                    </p>
                    <p>
                        <img src="../../imagenes/logo telefono.png" alt="Horario" width="16" height="16">
                        Lunes a Viernes 7:00am a 2:30pm
                    </p>
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
                <p>Copyright © 2017 Universidad Nacional San Martín Tarapoto - Perú</p>
                <div class="footer-social-bottom">
                    <span class="footer-social-title">SOCIALÍZATE</span>
                    <nav class="footer-social" aria-label="Redes sociales de la UNSM">
                        <a href="https://www.facebook.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="Facebook UNSM">
                            <img src="../../imagenes/redes/logo facebook.png" alt="Facebook" width="22" height="22">
                        </a>
                        <a href="https://www.instagram.com/unsmperu?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" aria-label="Instagram UNSM">
                            <img src="../../imagenes/redes/logo instagram.png" alt="Instagram" width="22" height="22">
                        </a>
                        <a href="https://youtube.com/@unsmperu?si=Lu9kVK7VlDX3qkj6" target="_blank" rel="noopener noreferrer" aria-label="YouTube UNSM">
                            <img src="../../imagenes/redes/logo yt.png" alt="YouTube" width="22" height="22">
                        </a>
                        <a href="https://x.com/unsmperu" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter) UNSM">
                            <img src="../../imagenes/redes/logo x.png" alt="X" width="22" height="22">
                        </a>
                        <a href="https://www.tiktok.com/@campus.unsm?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer" aria-label="TikTok UNSM">
                            <img src="../../imagenes/redes/logo tiktok.png" alt="TikTok" width="22" height="22">
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <script src="../../js/script.js" defer></script>
    <script src="js/scriptHim.js" defer></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v18.0"></script>
</body>
</html>

