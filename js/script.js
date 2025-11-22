'use strict';

/**
 * Objeto principal UNSM
 * Maneja toda la lógica del sitio web
 */
const UNSM = {
    // ============================================
    // ESTADO DE LA APLICACIÓN
    // ============================================
    state: {
        currentSlide: 0,
        totalSlides: 0,
        autoSlideInterval: null,
        currentFacultadesSlide: 0,
        totalFacultadesSlides: 11,
        currentAcademicSlide: 0,
        totalAcademicSlides: 6,
        isMenuOpen: false,
        isTransitioning: false, // Para evitar transiciones múltiples
    },

    // Datos de las facultades
    facultadesData: [
        {
            id: 'ciencias-agrarias',
            title: 'Ciencias Agrarias',
            description: 'Formando profesionales en agricultura sostenible',
            image: 'imagenes/facultades carreras/agrarias fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FCA-UNSM-2021.png'
        },
        {
            id: 'ciencias-salud',
            title: 'Ciencias de la Salud',
            description: 'Excelencia en formación médica y enfermería',
            image: 'imagenes/facultades carreras/salud fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FCS-UNSM-2021.png'
        },
        {
            id: 'medicina-humana',
            title: 'Medicina Humana',
            description: 'Formando médicos de excelencia para la región',
            image: 'imagenes/facultades carreras/medicina fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FMH-UNSM-2021.png'
        },
        {
            id: 'ingenieria-agroindustrial',
            title: 'Ingeniería Agroindustrial',
            description: 'Innovación en procesamiento agroindustrial',
            image: 'imagenes/facultades carreras/agroindustria fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FIAI-UNSM-2021.png'
        },
        {
            id: 'ingenieria-civil',
            title: 'Ingeniería Civil y Arquitectura',
            description: 'Construyendo el futuro de la región',
            image: 'imagenes/facultades carreras/ingenieria civil y arquitectura fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FICA-UNSM-2021.png'
        },
        {
            id: 'ingenieria-sistemas',
            title: 'Ingeniería de Sistemas',
            description: 'Tecnología e innovación digital',
            image: 'imagenes/facultades carreras/sistemas fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FISI-UNSM-2021.png'
        },
        {
            id: 'ecologia',
            title: 'Ecología',
            description: 'Preservando el medio ambiente amazónico',
            image: 'imagenes/facultades carreras/ecologia fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FECOL-UNSM-2021.png'
        },
        {
            id: 'educacion',
            title: 'Educación y Humanidades',
            description: 'Formando los educadores del mañana',
            image: 'imagenes/facultades carreras/educacion y humanidades fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FEH-UNSM-2021.png'
        },
        {
            id: 'ciencias-economicas',
            title: 'Ciencias Económicas',
            description: 'Formando líderes empresariales y económicos',
            image: 'imagenes/facultades carreras/ciencias economicas.png',
            shield: 'imagenes/Escudos de Facultades — UNSM/FCE-UNSM-2021.png'
        },
        {
            id: 'derecho',
            title: 'Derecho y Ciencias Políticas',
            description: 'Justicia y derecho para el desarrollo social',
            image: 'imagenes/facultades carreras/derecho fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/FDCP-UNSM-2021.png'
        },
        {
            id: 'medicina-veterinaria',
            title: 'Medicina Veterinaria',
            description: 'Cuidado integral de la salud animal',
            image: 'imagenes/facultades carreras/veterinaria fac.jpg',
            shield: 'imagenes/Escudos de Facultades — UNSM/MV - UNSM  2021.png'
        }
    ],

    // ============================================
    // INICIALIZACIÓN GLOBAL
    // ============================================
    init() {
        try {
            console.log('========================================');
            console.log('🚀 INICIANDO SITIO UNSM');
            console.log('========================================');

            this.initMainCarousel();
            console.log('✅ Carrusel principal inicializado');

            this.initFacultadesCarousel();
            console.log('✅ Carrusel de facultades inicializado');

            this.initAcademicCarousel();
            console.log('✅ Carrusel académico inicializado');

            this.initMobileMenu();
            console.log('✅ Menú móvil inicializado');

            this.initAccessibility();
            console.log('✅ Mejoras de accesibilidad aplicadas');

            this.exposeGlobalFunctions();
            console.log('✅ Funciones globales expuestas');

            this.initPerformanceOptimizations();
            console.log('✅ Optimizaciones de performance aplicadas');

            console.log('========================================');
            console.log('✅ SITIO COMPLETAMENTE CARGADO');
            console.log('========================================');
        } catch (error) {
            console.error('❌ Error durante la inicialización:', error);
        }
    },

    // ============================================
    // EXPONER FUNCIONES GLOBALES
    // ============================================
    exposeGlobalFunctions() {
        window.moveSlide = (direction) => {
            this.moveSlide(direction);
            this.resetAutoSlide();
        };
        
        window.moveFacultadesSlide = (direction) => {
            this.moveFacultadesSlide(direction);
        };
        
        window.moveAcademicSlide = (direction) => {
            this.moveAcademicSlide(direction);
        };
        
        console.log('✅ Funciones globales disponibles');
    },

    // ============================================
    // CARRUSEL PRINCIPAL
    // ============================================
    initMainCarousel() {
        const slides = document.querySelectorAll('.carousel-slide');
        this.state.totalSlides = slides.length;
        
        if (this.state.totalSlides === 0) {
            console.warn('⚠️ No se encontraron slides del carrusel principal');
            return;
        }

        this.createCarouselDots();
        this.startAutoSlide();
        
        // Precarga de imágenes para mejor performance
        this.preloadCarouselImages();
    },

    preloadCarouselImages() {
        const slides = document.querySelectorAll('.carousel-slide img');
        slides.forEach((img, index) => {
            if (index > 0) { // Skip primera imagen que ya está cargada
                const preloadImg = new Image();
                preloadImg.src = img.src;
            }
        });
    },

    createCarouselDots() {
        const controlsContainer = document.getElementById('carouselControls');
        if (!controlsContainer) return;

        controlsContainer.innerHTML = '';
        const fragment = document.createDocumentFragment();
        
        for (let i = 0; i < this.state.totalSlides; i++) {
            const dot = document.createElement('button');
            dot.classList.add('carousel-dot');
            dot.setAttribute('aria-label', `Ir al slide ${i + 1}`);
            dot.setAttribute('role', 'tab');
            dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
            
            if (i === 0) dot.classList.add('active');

            dot.addEventListener('click', () => {
                this.goToSlide(i);
                this.resetAutoSlide();
            });

            fragment.appendChild(dot);
        }
        
        controlsContainer.appendChild(fragment);
    },

    updateDots() {
        const dots = document.querySelectorAll('.carousel-dot');
        dots.forEach((dot, index) => {
            const isActive = index === this.state.currentSlide;
            dot.classList.toggle('active', isActive);
            dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    },

    moveSlide(direction) {
        this.state.currentSlide += direction;

        if (this.state.currentSlide >= this.state.totalSlides) {
            this.state.currentSlide = 0;
        } else if (this.state.currentSlide < 0) {
            this.state.currentSlide = this.state.totalSlides - 1;
        }

        this.updateCarousel();
    },

    goToSlide(index) {
        if (index >= 0 && index < this.state.totalSlides) {
            this.state.currentSlide = index;
            this.updateCarousel();
        }
    },

    updateCarousel() {
        const container = document.getElementById('carouselContainer');
        if (!container) return;

        const offset = -this.state.currentSlide * 100;
        container.style.transform = `translateX(${offset}%)`;
        this.updateDots();
    },

    startAutoSlide() {
        if (this.state.autoSlideInterval) {
            clearInterval(this.state.autoSlideInterval);
        }
        
        this.state.autoSlideInterval = setInterval(() => {
            this.moveSlide(1);
        }, 5000);
    },

    resetAutoSlide() {
        this.startAutoSlide();
    },

    // ============================================
    // CARRUSEL DE FACULTADES CON SCROLL INFINITO
    // ============================================
    initFacultadesCarousel() {
        console.log('🎓 Inicializando carrusel de facultades INFINITO...');
        
        // Construir el HTML del carrusel con clones
        this.buildFacultadesCarousel();
        
        // Crear los indicadores
        this.createFacultadesDots();
        
        // Configurar posición inicial
        this.setInitialFacultadesPosition();
        
        // Event listener para resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                this.handleFacultadesResize();
            }, 250);
        });
    },

    buildFacultadesCarousel() {
        const container = document.getElementById('facultadesCarouselContainer');
        if (!container) {
            console.error('❌ No se encontró el contenedor del carrusel de facultades');
            return;
        }

        // Crear el HTML de una tarjeta de facultad
        const createFacultadCard = (facultad) => {
            return `
                <article class="facultades-carousel-slide">
                    <a href="#${facultad.id}" class="card" aria-labelledby="${facultad.id}-title">
                        <div class="card-image" style="background-image: url('${facultad.image}'); background-size: cover; background-position: center;">
                            <div class="card-overlay-green">
                                <div class="card-icon-facultad">
                                    <img src="${facultad.shield}" alt="Escudo de ${facultad.title}" width="75" height="75">
                                </div>
                                <div class="card-content">
                                    <h3 id="${facultad.id}-title" class="card-title">${facultad.title}</h3>
                                    <p class="card-text">${facultad.description}</p>
                                    <span class="card-button">Ver más</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            `;
        };

        // Determinar cuántos clones necesitamos según el tamaño de pantalla
        const isMobile = window.innerWidth <= 768;
        const slidesPerView = isMobile ? 1 : 2;
        
        // Crear clones al final (copias de los primeros elementos)
        const clonesEnd = this.facultadesData.slice(0, slidesPerView).map(f => createFacultadCard(f)).join('');
        
        // Crear clones al inicio (copias de los últimos elementos)
        const clonesStart = this.facultadesData.slice(-slidesPerView).map(f => createFacultadCard(f)).join('');
        
        // Crear todos los elementos originales
        const originalSlides = this.facultadesData.map(f => createFacultadCard(f)).join('');
        
        // Construir el carrusel completo: clones inicio + originales + clones final
        container.innerHTML = clonesStart + originalSlides + clonesEnd;
        
        console.log(`✅ Carrusel construido: ${slidesPerView} clones inicio + ${this.facultadesData.length} originales + ${slidesPerView} clones final`);
    },

    setInitialFacultadesPosition() {
        const container = document.getElementById('facultadesCarouselContainer');
        if (!container) return;

        const isMobile = window.innerWidth <= 768;
        const slidesPerView = isMobile ? 1 : 2;
        const slideWidth = isMobile ? 100 : 50;
        
        // Posición inicial: después de los clones del inicio
        this.state.currentFacultadesSlide = slidesPerView;
        
        // Sin transición para el posicionamiento inicial
        container.style.transition = 'none';
        const offset = -this.state.currentFacultadesSlide * slideWidth;
        container.style.transform = `translateX(${offset}%)`;
        
        // Restaurar transición después de un frame
        setTimeout(() => {
            container.style.transition = 'transform 0.5s ease-in-out';
        }, 50);
        
        this.updateFacultadesDots();
    },

    handleFacultadesResize() {
        this.buildFacultadesCarousel();
        this.createFacultadesDots();
        this.setInitialFacultadesPosition();
    },

    createFacultadesDots() {
        const dotsContainer = document.getElementById('facultadesDots');
        if (!dotsContainer) return;

        const isMobile = window.innerWidth <= 768;
        const totalDots = isMobile ? 11 : 6;
        
        dotsContainer.innerHTML = '';
        const fragment = document.createDocumentFragment();

        for (let i = 0; i < totalDots; i++) {
            const dot = document.createElement('button');
            dot.classList.add('carousel-dot');
            dot.setAttribute('aria-label', `Grupo de facultades ${i + 1}`);
            dot.setAttribute('role', 'tab');
            dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
            
            if (i === 0) dot.classList.add('active');

            dot.addEventListener('click', () => {
                const isMobile = window.innerWidth <= 768;
                const slidesPerView = isMobile ? 1 : 2;
                const targetSlide = isMobile ? i + slidesPerView : (i * 2) + slidesPerView;
                this.goToFacultadesSlide(targetSlide);
            });
            
            fragment.appendChild(dot);
        }
        
        dotsContainer.appendChild(fragment);
    },

    updateFacultadesDots() {
        const dots = document.querySelectorAll('#facultadesDots .carousel-dot');
        const isMobile = window.innerWidth <= 768;
        const slidesPerView = isMobile ? 1 : 2;
        
        // Calcular el índice real (sin contar los clones)
        const realIndex = this.state.currentFacultadesSlide - slidesPerView;
        
        // Normalizar el índice para loop infinito
        let normalizedIndex = realIndex % this.state.totalFacultadesSlides;
        if (normalizedIndex < 0) normalizedIndex = this.state.totalFacultadesSlides + normalizedIndex;
        
        dots.forEach((dot, index) => {
            const isActive = isMobile ? 
                index === normalizedIndex : 
                index === Math.floor(normalizedIndex / 2);
            
            dot.classList.toggle('active', isActive);
            dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    },

    moveFacultadesSlide(direction) {
        if (this.state.isTransitioning) return;
        
        const isMobile = window.innerWidth <= 768;
        const step = isMobile ? 1 : 2;
        
        this.state.isTransitioning = true;
        this.state.currentFacultadesSlide += (direction * step);
        
        this.updateFacultadesCarousel(() => {
            this.checkFacultadesInfiniteLoop();
        });
    },

    goToFacultadesSlide(targetSlide) {
        if (this.state.isTransitioning) return;
        
        this.state.isTransitioning = true;
        this.state.currentFacultadesSlide = targetSlide;
        
        this.updateFacultadesCarousel(() => {
            this.checkFacultadesInfiniteLoop();
        });
    },

    updateFacultadesCarousel(callback) {
        const container = document.getElementById('facultadesCarouselContainer');
        if (!container) {
            console.error('❌ No se encontró el contenedor del carrusel de facultades');
            return;
        }

        const isMobile = window.innerWidth <= 768;
        const slideWidth = isMobile ? 100 : 50;
        
        const offset = -this.state.currentFacultadesSlide * slideWidth;
        container.style.transform = `translateX(${offset}%)`;
        this.updateFacultadesDots();
        
        // Callback después de la transición
        if (callback) {
            setTimeout(callback, 500); // 500ms = duración de la transición
        }
    },

    checkFacultadesInfiniteLoop() {
        const container = document.getElementById('facultadesCarouselContainer');
        if (!container) return;

        const isMobile = window.innerWidth <= 768;
        const slidesPerView = isMobile ? 1 : 2;
        const slideWidth = isMobile ? 100 : 50;
        const totalSlides = this.facultadesData.length;
        
        // Si estamos en el clon del final, saltar al original del inicio
        if (this.state.currentFacultadesSlide >= totalSlides + slidesPerView) {
            container.style.transition = 'none';
            this.state.currentFacultadesSlide = slidesPerView;
            const offset = -this.state.currentFacultadesSlide * slideWidth;
            container.style.transform = `translateX(${offset}%)`;
            
            setTimeout(() => {
                container.style.transition = 'transform 0.5s ease-in-out';
                this.state.isTransitioning = false;
            }, 50);
            
            this.updateFacultadesDots();
            return;
        }
        
        // Si estamos en el clon del inicio, saltar al original del final
        if (this.state.currentFacultadesSlide < slidesPerView) {
            container.style.transition = 'none';
            this.state.currentFacultadesSlide = totalSlides + (this.state.currentFacultadesSlide);
            const offset = -this.state.currentFacultadesSlide * slideWidth;
            container.style.transform = `translateX(${offset}%)`;
            
            setTimeout(() => {
                container.style.transition = 'transform 0.5s ease-in-out';
                this.state.isTransitioning = false;
            }, 50);
            
            this.updateFacultadesDots();
            return;
        }
        
        this.state.isTransitioning = false;
    },

    // ============================================
    // CARRUSEL ACADÉMICO (solo móvil)
    // ============================================
    initAcademicCarousel() {
        if (window.innerWidth <= 768) {
            this.createAcademicDots();
        }
        
        // Event listener para resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth <= 768) {
                    this.createAcademicDots();
                }
            }, 250);
        });
    },

    createAcademicDots() {
        const dotsContainer = document.getElementById('academicCarouselDots');
        if (!dotsContainer) return;

        dotsContainer.innerHTML = '';
        const fragment = document.createDocumentFragment();
        
        for (let i = 0; i < this.state.totalAcademicSlides; i++) {
            const dot = document.createElement('button');
            dot.classList.add('carousel-dot');
            dot.setAttribute('aria-label', `Tarjeta académica ${i + 1}`);
            dot.setAttribute('role', 'tab');
            dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
            
            if (i === 0) dot.classList.add('active');

            dot.addEventListener('click', () => {
                this.goToAcademicSlide(i);
            });
            
            fragment.appendChild(dot);
        }
        
        dotsContainer.appendChild(fragment);
    },

    updateAcademicDots() {
        const dots = document.querySelectorAll('#academicCarouselDots .carousel-dot');
        dots.forEach((dot, index) => {
            const isActive = index === this.state.currentAcademicSlide;
            dot.classList.toggle('active', isActive);
            dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    },

    moveAcademicSlide(direction) {
        this.state.currentAcademicSlide += direction;
        
        if (this.state.currentAcademicSlide >= this.state.totalAcademicSlides) {
            this.state.currentAcademicSlide = 0;
        } else if (this.state.currentAcademicSlide < 0) {
            this.state.currentAcademicSlide = this.state.totalAcademicSlides - 1;
        }
        
        this.updateAcademicCarousel();
    },

    goToAcademicSlide(index) {
        if (index >= 0 && index < this.state.totalAcademicSlides) {
            this.state.currentAcademicSlide = index;
            this.updateAcademicCarousel();
        }
    },

    updateAcademicCarousel() {
        const container = document.getElementById('academicCarouselContainer');
        if (!container) return;

        const offset = -this.state.currentAcademicSlide * 100;
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
        const hasSubmenu = document.querySelectorAll('.has-submenu');

        if (!toggle || !nav) {
            console.error('❌ Elementos del menú no encontrados');
            return;
        }

        // Crear overlay
        let overlay = document.querySelector('.menu-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'menu-overlay';
            document.body.appendChild(overlay);
        }

        // Toggle del menú
        const toggleMenu = (e) => {
            if (e) e.preventDefault();
            
            this.state.isMenuOpen = !this.state.isMenuOpen;
            
            nav.classList.toggle('active', this.state.isMenuOpen);
            toggle.classList.toggle('active', this.state.isMenuOpen);
            overlay.classList.toggle('active', this.state.isMenuOpen);
            
            document.body.style.overflow = this.state.isMenuOpen ? 'hidden' : '';
            toggle.setAttribute('aria-expanded', this.state.isMenuOpen ? 'true' : 'false');
        };

        const cerrarMenu = () => {
            this.state.isMenuOpen = false;
            nav.classList.remove('active');
            toggle.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            toggle.setAttribute('aria-expanded', 'false');
        };

        // Event listeners
        toggle.addEventListener('click', toggleMenu);
        toggle.addEventListener('touchstart', (e) => { 
            e.preventDefault(); 
            toggleMenu(e); 
        }, { passive: false });
        
        overlay.addEventListener('click', cerrarMenu);

        // Manejo de dropdowns de primer nivel
        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('a');
            if (link) {
                link.addEventListener('click', (e) => {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        dropdown.classList.toggle('active');
                    }
                });
            }
        });

        // Manejo de submenús multinivel (segundo nivel)
        hasSubmenu.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                link.addEventListener('click', (e) => {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        e.stopPropagation();
                        item.classList.toggle('active');
                    }
                });
            }
        });

        // Cerrar menú al hacer clic en links (excepto dropdowns)
        nav.querySelectorAll('a:not(.dropdown > a):not(.has-submenu > a)').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    cerrarMenu();
                }
            });
        });

        // Ajustar comportamiento al redimensionar
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth > 768) {
                    cerrarMenu();
                }
            }, 250);
        });

        console.log('✅ Menú móvil completamente inicializado');
    },

    // ============================================
    // MEJORAS DE ACCESIBILIDAD
    // ============================================
    initAccessibility() {
        // Manejo de navegación por teclado en carruseles
        this.initKeyboardNavigation();
        
        // Mejorar focus visible en elementos interactivos
        this.improveFocusVisibility();
        
        // Anunciar cambios de slide a lectores de pantalla
        this.setupAriaLive();
    },

    initKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            // Carrusel principal
            if (e.target.closest('.carousel')) {
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    this.moveSlide(-1);
                    this.resetAutoSlide();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    this.moveSlide(1);
                    this.resetAutoSlide();
                }
            }
        });
    },

    improveFocusVisibility() {
        // Agregar clase cuando se navega por teclado
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-nav');
            }
        });

        document.addEventListener('mousedown', () => {
            document.body.classList.remove('keyboard-nav');
        });
    },

    setupAriaLive() {
        const carousel = document.querySelector('.carousel');
        if (carousel) {
            const liveRegion = document.createElement('div');
            liveRegion.setAttribute('aria-live', 'polite');
            liveRegion.setAttribute('aria-atomic', 'true');
            liveRegion.className = 'sr-only';
            carousel.appendChild(liveRegion);

            // Actualizar región live cuando cambie el slide
            const originalUpdateCarousel = this.updateCarousel.bind(this);
            this.updateCarousel = function() {
                originalUpdateCarousel();
                liveRegion.textContent = `Slide ${this.state.currentSlide + 1} de ${this.state.totalSlides}`;
            };
        }
    },

    // ============================================
    // OPTIMIZACIONES DE PERFORMANCE
    // ============================================
    initPerformanceOptimizations() {
        // Lazy loading para imágenes que no son del primer viewport
        this.initLazyLoading();
        
        // Debounce para eventos de resize
        this.setupResizeDebounce();
        
        // Prefetch de recursos importantes
        this.prefetchResources();
    },

    initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px'
            });

            // Observar imágenes con data-src
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    },

    setupResizeDebounce() {
        let resizeTimer;
        const handleResize = () => {
            // Acciones al redimensionar
            this.handleFacultadesResize();
        };

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(handleResize, 250);
        });
    },

    prefetchResources() {
        // Prefetch de páginas importantes
        const prefetchLinks = [
            '/admision',
            '/facultades',
            '/posgrado'
        ];

        prefetchLinks.forEach(link => {
            const prefetchLink = document.createElement('link');
            prefetchLink.rel = 'prefetch';
            prefetchLink.href = link;
            document.head.appendChild(prefetchLink);
        });
    },

    // ============================================
    // UTILIDADES
    // ============================================
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
};

// ============================================
// INICIALIZACIÓN AL CARGAR EL DOM
// ============================================
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => UNSM.init());
} else {
    UNSM.init();
}

// ============================================
// MANEJO DE ERRORES GLOBAL
// ============================================
window.addEventListener('error', (event) => {
    console.error('Error global capturado:', event.error);
});

window.addEventListener('unhandledrejection', (event) => {
    console.error('Promise rechazada no manejada:', event.reason);
});

// ============================================
// EXPORTAR PARA USO EN MÓDULOS (OPCIONAL)
// ============================================
if (typeof module !== 'undefined' && module.exports) {
    module.exports = UNSM;
}
