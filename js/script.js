// ============================================
// PROYECTO UNSM - SCRIPT PRINCIPAL
// Autor: Luighy Andre Alvarado Reyna
// Versión: 2.0 - MEJORADO
// Fecha: Noviembre 2025
// ============================================

const UNSM = {
    // Estado general
    currentSlide: 0,
    totalSlides: 0,
    autoSlideInterval: null,

    currentFacultadesSlide: 0,
    totalFacultadesSlides: 11, // Ahora son 11 facultades individuales

    currentAcademicSlide: 0,
    totalAcademicSlides: 6,

    // ============================================
    // INICIALIZACIÓN GLOBAL
    // ============================================
    init() {
        console.log('========================================');
        console.log('🚀 INICIANDO SITIO UNSM');
        console.log('========================================');

        this.initMainCarousel();
        console.log('✅ Carrusel principal OK');

        this.initFacultadesCarousel();
        console.log('✅ Carrusel facultades OK');

        this.initAcademicCarousel();
        console.log('✅ Carrusel académico OK');

        this.initMobileMenu();
        console.log('✅ Menú móvil OK');

        this.exposeGlobalFunctions();
        console.log('✅ Funciones globales expuestas OK');

        console.log('========================================');
        console.log('✅ SITIO COMPLETAMENTE CARGADO');
        console.log('========================================');
    },

    // ============================================
    // EXPONER FUNCIONES GLOBALES
    // ============================================
    exposeGlobalFunctions() {
        // Exponer funciones del carrusel principal al scope global
        window.moveSlide = (direction) => {
            this.moveSlide(direction);
            this.resetAutoSlide();
        };
        
        // Exponer funciones del carrusel de facultades al scope global
        window.moveFacultadesSlide = (direction) => this.moveFacultadesSlide(direction);
        
        // Exponer funciones del carrusel académico al scope global
        window.moveAcademicSlide = (direction) => this.moveAcademicSlide(direction);
        
        console.log('✅ Funciones globales disponibles: moveSlide(), moveFacultadesSlide(), moveAcademicSlide()');
    },

    // ============================================
    // CARRUSEL PRINCIPAL
    // ============================================
    initMainCarousel() {
        this.totalSlides = document.querySelectorAll('.carousel-slide').length;
        if (this.totalSlides === 0) return;

        this.createCarouselDots();
        this.startAutoSlide();
        
        // NO agregamos event listeners porque los botones ya tienen onclick
        // Esto evita el doble disparo
    },

    createCarouselDots() {
        const controlsContainer = document.getElementById('carouselControls');
        if (!controlsContainer) return;

        controlsContainer.innerHTML = '';
        for (let i = 0; i < this.totalSlides; i++) {
            const dot = document.createElement('button');
            dot.classList.add('carousel-dot');
            if (i === 0) dot.classList.add('active');

            dot.addEventListener('click', () => {
                this.goToSlide(i);
                this.resetAutoSlide();
            });

            controlsContainer.appendChild(dot);
        }
    },

    updateDots() {
        const dots = document.querySelectorAll('.carousel-dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentSlide);
        });
    },

    moveSlide(direction) {
        this.currentSlide += direction;

        if (this.currentSlide >= this.totalSlides) this.currentSlide = 0;
        else if (this.currentSlide < 0) this.currentSlide = this.totalSlides - 1;

        this.updateCarousel();
    },

    goToSlide(index) {
        this.currentSlide = index;
        this.updateCarousel();
    },

    updateCarousel() {
        const container = document.getElementById('carouselContainer');
        if (!container) return;

        const offset = -this.currentSlide * 100;
        container.style.transform = `translateX(${offset}%)`;
        this.updateDots();
    },

    startAutoSlide() {
        if (this.autoSlideInterval) clearInterval(this.autoSlideInterval);
        this.autoSlideInterval = setInterval(() => this.moveSlide(1), 5000);
    },

    resetAutoSlide() {
        this.startAutoSlide();
    },

    // ============================================
    // ============================================
    // CARRUSEL DE FACULTADES
    // ============================================
    initFacultadesCarousel() {
        console.log('🎓 Inicializando carrusel de facultades...');
        this.createFacultadesDots();
        console.log('✅ Carrusel de facultades completamente inicializado');
    },

    createFacultadesDots() {
        const dotsContainer = document.getElementById('facultadesDots');
        if (!dotsContainer) return;

        dotsContainer.innerHTML = '';
        
        // En desktop: 6 dots (2 facultades por dot)
        // En móvil: 11 dots (1 facultad por dot)
        const isMobile = window.innerWidth <= 768;
        const totalDots = isMobile ? 11 : 6;

        for (let i = 0; i < totalDots; i++) {
            const dot = document.createElement('button');
            dot.classList.add('carousel-dot');
            if (i === 0) dot.classList.add('active');

            dot.addEventListener('click', () => {
                // En desktop, cada dot representa 2 facultades
                // En móvil, cada dot representa 1 facultad
                const targetSlide = isMobile ? i : i * 2;
                this.goToFacultadesSlide(targetSlide);
            });
            dotsContainer.appendChild(dot);
        }
    },

    updateFacultadesDots() {
        const dots = document.querySelectorAll('#facultadesDots .carousel-dot');
        const isMobile = window.innerWidth <= 768;
        
        dots.forEach((dot, index) => {
            // En desktop: activar dot según posición par (0,2,4,6,8,10 -> dots 0,1,2,3,4,5)
            // En móvil: activar dot según posición exacta
            const isActive = isMobile ? 
                index === this.currentFacultadesSlide : 
                index === Math.floor(this.currentFacultadesSlide / 2);
            dot.classList.toggle('active', isActive);
        });
    },

    moveFacultadesSlide(direction) {
        console.log(`📍 Moviendo carrusel de facultades: ${direction > 0 ? 'siguiente' : 'anterior'}`);
        console.log(`📍 Slide actual: ${this.currentFacultadesSlide}`);
        
        const isMobile = window.innerWidth <= 768;
        const step = isMobile ? 1 : 2; // En desktop saltar de 2 en 2, en móvil de 1 en 1
        
        this.currentFacultadesSlide += (direction * step);
        
        if (this.currentFacultadesSlide >= this.totalFacultadesSlides) {
            this.currentFacultadesSlide = 0;
        } else if (this.currentFacultadesSlide < 0) {
            // En desktop, ir al último par (slide 10)
            // En móvil, ir al último slide (slide 10)
            this.currentFacultadesSlide = isMobile ? this.totalFacultadesSlides - 1 : 10;
        }
        
        console.log(`📍 Nuevo slide: ${this.currentFacultadesSlide}`);
        this.updateFacultadesCarousel();
    },

    goToFacultadesSlide(index) {
        console.log(`📍 Ir al slide: ${index}`);
        this.currentFacultadesSlide = index;
        this.updateFacultadesCarousel();
    },

    updateFacultadesCarousel() {
        const container = document.getElementById('facultadesCarouselContainer');
        if (!container) {
            console.error('❌ No se encontró el contenedor del carrusel de facultades');
            return;
        }

        const isMobile = window.innerWidth <= 768;
        // En desktop cada slide es 50% de ancho, en móvil 100%
        const slideWidth = isMobile ? 100 : 50;
        const offset = -this.currentFacultadesSlide * slideWidth;
        
        container.style.transform = `translateX(${offset}%)`;
        console.log(`✅ Transform aplicado: translateX(${offset}%)`);
        
        this.updateFacultadesDots();
    },
    // ============================================
    // CARRUSEL ACADÉMICO (solo móvil)
    // ============================================
    initAcademicCarousel() {
        if (window.innerWidth <= 768) {
            this.createAcademicDots();
            
            // NO agregamos event listeners porque los botones ya tienen onclick
            // Esto evita el doble disparo
        }
    },

    createAcademicDots() {
        const dotsContainer = document.getElementById('academicCarouselDots');
        if (!dotsContainer) return;

        dotsContainer.innerHTML = '';
        for (let i = 0; i < this.totalAcademicSlides; i++) {
            const dot = document.createElement('button');
            dot.classList.add('carousel-dot');
            if (i === 0) dot.classList.add('active');

            dot.addEventListener('click', () => this.goToAcademicSlide(i));
            dotsContainer.appendChild(dot);
        }
    },

    updateAcademicDots() {
        const dots = document.querySelectorAll('#academicCarouselDots .carousel-dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentAcademicSlide);
        });
    },

    moveAcademicSlide(direction) {
        this.currentAcademicSlide += direction;
        if (this.currentAcademicSlide >= this.totalAcademicSlides) this.currentAcademicSlide = 0;
        else if (this.currentAcademicSlide < 0) this.currentAcademicSlide = this.totalAcademicSlides - 1;
        this.updateAcademicCarousel();
    },

    goToAcademicSlide(index) {
        this.currentAcademicSlide = index;
        this.updateAcademicCarousel();
    },

    updateAcademicCarousel() {
        const container = document.getElementById('academicCarouselContainer');
        if (!container) return;

        const offset = -this.currentAcademicSlide * 100;
        container.style.transform = `translateX(${offset}%)`;
        this.updateAcademicDots();
    },

    // ============================================
    // MENÚ MÓVIL
    // ============================================
    initMobileMenu() {
        console.log('🔧 Iniciando menú móvil...');
        const toggle = document.querySelector('.mobile-menu-toggle');
        const nav = document.querySelector('.main-nav');
        const dropdowns = document.querySelectorAll('.dropdown');

        if (!toggle || !nav) {
            console.error('❌ Elementos del menú no encontrados');
            return;
        }

        let overlay = document.querySelector('.menu-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'menu-overlay';
            document.body.appendChild(overlay);
            console.log('✅ Overlay creado');
        }

        let menuAbierto = false;

        const toggleMenu = (e) => {
            if (e) e.preventDefault();
            menuAbierto = !menuAbierto;
            nav.classList.toggle('active', menuAbierto);
            toggle.classList.toggle('active', menuAbierto);
            overlay.classList.toggle('active', menuAbierto);
            document.body.style.overflow = menuAbierto ? 'hidden' : '';
            toggle.setAttribute('aria-expanded', menuAbierto ? 'true' : 'false');
        };

        const cerrarMenu = () => {
            menuAbierto = false;
            nav.classList.remove('active');
            toggle.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            toggle.setAttribute('aria-expanded', 'false');
        };

        // Eventos
        toggle.addEventListener('click', toggleMenu);
        toggle.addEventListener('touchstart', (e) => { 
            e.preventDefault(); 
            toggleMenu(e); 
        }, { passive: false });
        
        overlay.addEventListener('click', cerrarMenu);

        // Manejo de dropdowns (primer nivel)
        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('a');
            if (link) {
                const toggleDropdown = (e) => {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        dropdown.classList.toggle('active');
                    }
                };
                link.addEventListener('click', toggleDropdown);
            }
        });

        // Manejo de submenús multinivel (segundo nivel) - NUEVO
        const facultadesConSubmenu = document.querySelectorAll('.has-submenu');
        facultadesConSubmenu.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                const toggleSubmenu = (e) => {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        e.stopPropagation(); // Evitar que se propague al dropdown padre
                        item.classList.toggle('active');
                    }
                };
                link.addEventListener('click', toggleSubmenu);
            }
        });

        // Cerrar menú al hacer clic en links (excepto dropdowns y has-submenu)
        nav.querySelectorAll('a:not(.dropdown > a):not(.has-submenu > a)').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) cerrarMenu();
            });
        });

        // Ajustar comportamiento al redimensionar
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth > 768) cerrarMenu();
                if (window.innerWidth <= 768) this.initAcademicCarousel();
            }, 250);
        });

        console.log('✅ Menú móvil COMPLETAMENTE inicializado');
    }
};

// ============================================
// EVENTO PRINCIPAL
// ============================================
document.addEventListener('DOMContentLoaded', () => UNSM.init());