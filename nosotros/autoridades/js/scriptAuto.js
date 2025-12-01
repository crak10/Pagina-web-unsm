/**
 * UNSM - Script para Página de Autoridades
 * Funcionalidades específicas para Autoridades Universitarias y Decanos
 */

'use strict';

const UNSM_AUTORIDADES = {
    // ============================================
    // INICIALIZACIÓN
    // ============================================
    init() {
        console.log('🚀 UNSM Autoridades - Iniciando...');
        
        this.initMobileMenu();
        this.initSmoothScroll();
        this.initScrollEffects();
        this.initAuthorityCards();
        this.initDeanCards();
        this.initResolucionButtons();
        this.initAuthoritiesCarousel();
        
        console.log('✅ UNSM Autoridades - Cargado completamente');
    },

    // ============================================
    // MENÚ MÓVIL
    // ============================================
    initMobileMenu() {
        const menuBtn = document.querySelector('.mobile-menu-toggle');
        const nav = document.querySelector('.main-nav');
        
        if (!menuBtn || !nav) return;

        menuBtn.addEventListener('click', () => {
            nav.classList.toggle('active');
            menuBtn.classList.toggle('active');
            const isExpanded = menuBtn.classList.contains('active');
            menuBtn.setAttribute('aria-expanded', isExpanded);
            
            // Animar las líneas del botón hamburguesa
            const spans = menuBtn.querySelectorAll('span');
            if (menuBtn.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translateY(10px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translateY(-10px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });

        // Cerrar menú al hacer clic en un enlace
        const navLinks = nav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    nav.classList.remove('active');
                    menuBtn.classList.remove('active');
                    menuBtn.setAttribute('aria-expanded', 'false');
                    
                    const spans = menuBtn.querySelectorAll('span');
                    spans[0].style.transform = 'none';
                    spans[1].style.opacity = '1';
                    spans[2].style.transform = 'none';
                }
            });
        });

        // Cerrar menú al redimensionar a desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                nav.classList.remove('active');
                menuBtn.classList.remove('active');
                menuBtn.setAttribute('aria-expanded', 'false');
                
                const spans = menuBtn.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    },

    // ============================================
    // SMOOTH SCROLL
    // ============================================
    initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                
                // Ignorar enlaces vacíos o solo "#"
                if (href === '#' || href === '#!') return;
                
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    
                    const headerOffset = 80; // Altura del header
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    },

    // ============================================
    // EFECTOS DE SCROLL
    // ============================================
    initScrollEffects() {
        const header = document.querySelector('.main-header');
        
        if (!header) return;

        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            // Agregar sombra al header al hacer scroll
            if (currentScroll > 50) {
                header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
            } else {
                header.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
            }

            lastScroll = currentScroll;
        });

        // Intersection Observer para animaciones fade-in en las tarjetas
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Agregar delay escalonado para efecto cascada
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observar tarjetas de autoridades y decanos
        const authorityCards = document.querySelectorAll('.authority-card, .dean-card');
        authorityCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    },

    // ============================================
    // EFECTOS EN TARJETAS DE AUTORIDADES
    // ============================================
    initAuthorityCards() {
        const authorityCards = document.querySelectorAll('.authority-card');
        
        authorityCards.forEach(card => {
            const image = card.querySelector('.authority-image img');
            
            // Efecto de zoom en la imagen al hover
            card.addEventListener('mouseenter', () => {
                if (image) {
                    image.style.transform = 'scale(1.05)';
                    image.style.transition = 'transform 0.3s ease';
                }
            });
            
            card.addEventListener('mouseleave', () => {
                if (image) {
                    image.style.transform = 'scale(1)';
                }
            });

            // Efecto de click en la tarjeta completa
            card.addEventListener('click', (e) => {
                // No hacer nada si se hace click en el botón
                if (e.target.classList.contains('btn-resolucion')) {
                    return;
                }
                // Aquí puedes agregar funcionalidad adicional si es necesario
            });
        });
    },

    // ============================================
    // EFECTOS EN TARJETAS DE DECANOS
    // ============================================
    initDeanCards() {
        const deanCards = document.querySelectorAll('.dean-card');
        
        deanCards.forEach(card => {
            const image = card.querySelector('.dean-image img');
            
            // Efecto de zoom en la imagen al hover
            card.addEventListener('mouseenter', () => {
                if (image) {
                    image.style.transform = 'scale(1.05)';
                    image.style.transition = 'transform 0.3s ease';
                }
            });
            
            card.addEventListener('mouseleave', () => {
                if (image) {
                    image.style.transform = 'scale(1)';
                }
            });
        });
    },

    // ============================================
    // BOTONES DE RESOLUCIÓN
    // ============================================
    initResolucionButtons() {
        const resolucionButtons = document.querySelectorAll('.btn-resolucion');
        
        resolucionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                // Obtener el nombre de la autoridad desde la tarjeta
                const card = button.closest('.authority-card');
                const authorityName = card ? card.querySelector('h3').textContent : 'Autoridad';
                
                // Efecto visual al hacer click
                button.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    button.style.transform = 'scale(1)';
                }, 150);
                
                // Aquí puedes agregar la funcionalidad para mostrar la resolución
                // Por ejemplo, abrir un modal, redirigir a una página, etc.
                console.log(`Resolución solicitada para: ${authorityName}`);
                
                // Ejemplo: mostrar alerta (puedes reemplazar esto con tu lógica)
                // alert(`Resolución de ${authorityName}`);
                
                // O abrir un modal (si tienes uno implementado)
                // this.showResolucionModal(authorityName);
            });
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

    // Función para mostrar modal de resolución (opcional)
    showResolucionModal(authorityName) {
        // Implementar modal si es necesario
        console.log(`Mostrar modal de resolución para: ${authorityName}`);
    },

    // ============================================
    // CARRUSEL DE AUTORIDADES (MÓVIL) - INFINITO
    // ============================================
    initAuthoritiesCarousel() {
        const carousel = document.getElementById('authoritiesCarousel');
        const indicators = document.getElementById('authoritiesCarouselDots');
        
        if (!carousel || !indicators) return;

        // Solo aplicar carrusel infinito en móvil
        const isMobile = window.innerWidth <= 768;
        if (!isMobile) {
            // En desktop, solo crear indicadores sin carrusel
            const slides = carousel.querySelectorAll('.carousel-slide, .authority-card');
            slides.forEach((_, index) => {
                const button = document.createElement('button');
                button.setAttribute('role', 'tab');
                button.setAttribute('aria-label', `Ir a slide ${index + 1}`);
                if (index === 0) {
                    button.classList.add('active');
                }
                indicators.appendChild(button);
            });
            return;
        }

        // Esperar a que el DOM esté completamente renderizado
        setTimeout(() => {
            // Limpiar clones existentes primero
            carousel.querySelectorAll('.clone-slide').forEach(clone => clone.remove());
            
            const originalSlides = Array.from(carousel.querySelectorAll('.authority-card:not(.clone-slide)'));
            if (originalSlides.length === 0) return;

            // Encontrar el índice del rector en los slides originales
            const rectorIndex = originalSlides.findIndex(slide => slide.classList.contains('authority-card-rector'));
            const startIndex = rectorIndex >= 0 ? rectorIndex : 0;

            // Clonar slides para carrusel infinito
            // Clonar el último slide y ponerlo al inicio
            const lastSlide = originalSlides[originalSlides.length - 1];
            const lastClone = lastSlide.cloneNode(true);
            lastClone.classList.add('clone-slide');
            lastClone.classList.remove('authority-card-rector'); // Quitar clase de rector si existe
            
            // Clonar el primer slide y ponerlo al final
            const firstSlide = originalSlides[0];
            const firstClone = firstSlide.cloneNode(true);
            firstClone.classList.add('clone-slide');
            firstClone.classList.remove('authority-card-rector'); // Quitar clase de rector si existe
            
            // Insertar clones
            carousel.insertBefore(lastClone, originalSlides[0]);
            carousel.appendChild(firstClone);

            // Obtener todos los slides después de insertar clones
            const allSlides = Array.from(carousel.querySelectorAll('.authority-card'));
            const totalSlides = originalSlides.length;
            
            // El índice actual debe considerar el clone al inicio
            // Si el rector está en el índice 0, después de insertar el clone, estará en el índice 1
            let currentSlide = startIndex + 1; // +1 por el clone al inicio
            let isScrolling = false;

            // Limpiar indicadores existentes
            indicators.innerHTML = '';

            // Crear indicadores (solo para slides originales)
            originalSlides.forEach((_, index) => {
                const button = document.createElement('button');
                button.setAttribute('role', 'tab');
                button.setAttribute('aria-label', `Ir a slide ${index + 1}`);
                if (index === startIndex) {
                    button.classList.add('active');
                }
                button.addEventListener('click', () => {
                    goToSlide(index + 1, true);
                });
                indicators.appendChild(button);
            });

            // Función para obtener el tamaño del slide y padding
            const getSlideSize = () => {
                if (allSlides.length === 0) return { width: 0, gap: 0, total: 0, padding: 0 };
                // Usar el primer slide original (no clone) para obtener el tamaño
                const originalSlide = originalSlides[0];
                if (!originalSlide) return { width: 0, gap: 0, total: 0, padding: 0 };
                
                const slideWidth = originalSlide.offsetWidth;
                const gap = parseInt(getComputedStyle(carousel).gap) || 0;
                const paddingLeft = parseInt(getComputedStyle(carousel).paddingLeft) || 0;
                return { width: slideWidth, gap: gap, total: slideWidth + gap, padding: paddingLeft };
            };

            // Función para ir a un slide específico
            const goToSlide = (index, smooth = true) => {
                if (isScrolling) return;
                // Solo permitir índices de slides reales (1 a totalSlides)
                if (index < 1 || index > totalSlides) return;
                
                isScrolling = true;
                
                const targetSlide = allSlides[index];
                if (!targetSlide) {
                    isScrolling = false;
                    return;
                }
                
                // Usar la posición real del slide
                const slidePosition = targetSlide.offsetLeft;
                
                carousel.scrollTo({
                    left: slidePosition,
                    behavior: smooth ? 'smooth' : 'auto'
                });
                
                currentSlide = index;
                updateIndicators();
                
                setTimeout(() => {
                    isScrolling = false;
                }, smooth ? 600 : 100);
            };

            // Actualizar indicadores
            const updateIndicators = () => {
                const indicatorButtons = indicators.querySelectorAll('button');
                let realIndex = currentSlide - 1; // Restar el clone inicial
                if (realIndex < 0) realIndex = totalSlides - 1;
                if (realIndex >= totalSlides) realIndex = 0;
                
                indicatorButtons.forEach((btn, index) => {
                    if (index === realIndex) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            };

            // Detectar cambio de slide con scroll y manejar infinito
            let scrollTimeout;
            const handleScroll = () => {
                if (isScrolling) return;
                
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    const scrollLeft = carousel.scrollLeft;
                    const slideSize = getSlideSize();
                    if (slideSize.total === 0) return;
                    
                    // Obtener posiciones de los slides clave
                    const firstClone = allSlides[0];
                    const firstRealSlide = allSlides[1];
                    const lastRealSlide = allSlides[totalSlides];
                    const lastClone = allSlides[allSlides.length - 1];
                    
                    if (!firstClone || !firstRealSlide || !lastRealSlide || !lastClone) return;
                    
                    const firstCloneRight = firstClone.offsetLeft + firstClone.offsetWidth;
                    const lastCloneLeft = lastClone.offsetLeft;
                    const scrollRight = scrollLeft + carousel.offsetWidth;
                    
                    // Detectar si está cerca o ha pasado el clone del inicio (yendo hacia atrás)
                    // Saltar antes de que se vea completamente el clone
                    if (scrollLeft < firstRealSlide.offsetLeft - 10) {
                        isScrolling = true;
                        carousel.scrollTo({
                            left: lastRealSlide.offsetLeft,
                            behavior: 'auto'
                        });
                        currentSlide = totalSlides;
                        updateIndicators();
                        setTimeout(() => { isScrolling = false; }, 100);
                        return;
                    }
                    
                    // Detectar si está cerca o ha pasado el último slide real (yendo hacia adelante)
                    // Saltar cuando el scroll esté cerca del clone final
                    const lastRealSlideRight = lastRealSlide.offsetLeft + lastRealSlide.offsetWidth;
                    if (scrollLeft > lastRealSlideRight - 10) {
                        isScrolling = true;
                        carousel.scrollTo({
                            left: firstRealSlide.offsetLeft,
                            behavior: 'auto'
                        });
                        currentSlide = 1;
                        updateIndicators();
                        setTimeout(() => { isScrolling = false; }, 100);
                        return;
                    }
                    
                    // Encontrar el slide más cercano al scroll actual (solo slides reales)
                    let closestSlide = null;
                    let closestDistance = Infinity;
                    
                    // Solo buscar entre slides reales (índices 1 a totalSlides)
                    for (let i = 1; i <= totalSlides; i++) {
                        const slide = allSlides[i];
                        if (!slide) continue;
                        
                        const slideCenter = slide.offsetLeft + (slide.offsetWidth / 2);
                        const scrollCenter = scrollLeft + (carousel.offsetWidth / 2);
                        const distance = Math.abs(scrollCenter - slideCenter);
                        
                        if (distance < closestDistance) {
                            closestDistance = distance;
                            closestSlide = i;
                        }
                    }
                    
                    if (closestSlide !== null && closestSlide !== currentSlide) {
                        currentSlide = closestSlide;
                        updateIndicators();
                    }
                }, 50);
            };

            carousel.addEventListener('scroll', handleScroll, { passive: true });

            // Función para mover slides (infinito)
            window.moveAuthoritySlide = (direction) => {
                if (isScrolling) return;
                
                let newSlide = currentSlide + direction;
                
                // Si va más allá del final, ir al primer slide real (que está después del clone)
                if (newSlide > totalSlides) {
                    // Ir al primer slide real (índice 1)
                    newSlide = 1;
                    goToSlide(newSlide, true);
                }
                // Si va antes del inicio, ir al último slide real
                else if (newSlide < 1) {
                    // Ir al último slide real (índice totalSlides)
                    newSlide = totalSlides;
                    goToSlide(newSlide, true);
                }
                else {
                    // Movimiento normal
                    goToSlide(newSlide, true);
                }
            };

            // Scroll inicial al rector (después de que se rendericen los clones)
            setTimeout(() => {
                // Asegurar que los slides estén completamente renderizados
                if (allSlides.length > 0 && allSlides[1]) {
                    const targetIndex = startIndex + 1; // +1 porque el índice 0 es el clone
                    if (targetIndex >= 1 && targetIndex <= totalSlides) {
                        goToSlide(targetIndex, false);
                    }
                }
            }, 400);
        }, 100);
    }
};

// ============================================
// INICIALIZACIÓN AL CARGAR
// ============================================
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => UNSM_AUTORIDADES.init());
} else {
    UNSM_AUTORIDADES.init();
}

// Reinicializar carrusel cuando cambia el tamaño de la ventana
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        UNSM_AUTORIDADES.initAuthoritiesCarousel();
    }, 250);
});

// ============================================
// MANEJO DE ERRORES
// ============================================
window.addEventListener('error', (event) => {
    console.error('Error capturado:', event.error);
});

window.addEventListener('unhandledrejection', (event) => {
    console.error('Promise rechazada:', event.reason);
});

