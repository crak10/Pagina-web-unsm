/**
 * UNSM Website - Script Principal v2
 * Versión limpia y moderna
 */

'use strict';

const UNSM_V2 = {
    // ============================================
    // INICIALIZACIÓN
    // ============================================
    init() {
        console.log('🚀 UNSM Website V2 - Iniciando...');
        
        this.initMobileMenu();
        this.initSmoothScroll();
        this.initScrollEffects();
        
        console.log('✅ UNSM Website V2 - Cargado completamente');
    },

    // ============================================
    // MENÚ MÓVIL
    // ============================================
    initMobileMenu() {
        const menuBtn = document.querySelector('.mobile-menu-btn');
        const nav = document.querySelector('.main-nav');
        
        if (!menuBtn || !nav) return;

        menuBtn.addEventListener('click', () => {
            nav.classList.toggle('active');
            menuBtn.classList.toggle('active');
            
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

        // Intersection Observer para animaciones fade-in
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observar elementos que queremos animar
        const animatedElements = document.querySelectorAll('.content-section, .card, .footer-column');
        animatedElements.forEach(el => observer.observe(el));
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
    }
};

// ============================================
// INICIALIZACIÓN AL CARGAR
// ============================================
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => UNSM_V2.init());
} else {
    UNSM_V2.init();
}

// ============================================
// MANEJO DE ERRORES
// ============================================
window.addEventListener('error', (event) => {
    console.error('Error capturado:', event.error);
});

window.addEventListener('unhandledrejection', (event) => {
    console.error('Promise rechazada:', event.reason);
});