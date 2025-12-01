/**
 * UNSM Historia - Script Principal
 * Versión adaptada para la sección de historia
 */

'use strict';

const UNSM_Historia = {
    // ============================================
    // INICIALIZACIÓN
    // ============================================
    init() {
        console.log('🚀 UNSM Historia - Iniciando...');

        this.initMobileMenu();
        this.initScrollEffects();

        console.log('✅ UNSM Historia - Cargado completamente');
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
    // EFECTOS DE SCROLL
    // ============================================
    initScrollEffects() {
        const header = document.querySelector('.main-header');

        if (!header) return;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
            } else {
                header.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
            }
        });

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

        const animatedElements = document.querySelectorAll('.content-section, .footer-column');
        animatedElements.forEach(el => observer.observe(el));
    }
};

// ============================================
// INICIALIZACIÓN AL CARGAR
// ============================================
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => UNSM_Historia.init());
} else {
    UNSM_Historia.init();
}