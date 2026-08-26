import './bootstrap';

/**
 * Bulletproof Staggered Scroll-Reveal Engine for Laravel Blade
 */
document.addEventListener("DOMContentLoaded", function() {
    function initStaggerAnimations() {
        if (!('IntersectionObserver' in window) || (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) {
            document.querySelectorAll('.reveal-card').forEach(card => card.classList.add('is-visible'));
            return;
        }

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const cards = entry.target.querySelectorAll('.reveal-card');
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('is-visible');
                        }, index * 120); // 120ms stagger delay
                    });
                    observer.unobserve(entry.target); // Run only once
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });

        const wrappers = document.querySelectorAll('.stagger-wrapper');
        wrappers.forEach(wrapper => {
            observer.observe(wrapper);
            // Immediate trigger if above the fold
            const rect = wrapper.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                const cards = wrapper.querySelectorAll('.reveal-card');
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.classList.add('is-visible');
                    }, index * 80);
                });
                observer.unobserve(wrapper);
            }
        });

        // Standalone cards not inside a .stagger-wrapper
        document.querySelectorAll('.reveal-card').forEach(card => {
            if (!card.closest('.stagger-wrapper')) {
                const rect = card.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    card.classList.add('is-visible');
                } else {
                    const singleObs = new IntersectionObserver((entries, obs) => {
                        entries.forEach(e => {
                            if (e.isIntersecting) {
                                e.target.classList.add('is-visible');
                                obs.unobserve(e.target);
                            }
                        });
                    }, { threshold: 0.08 });
                    singleObs.observe(card);
                }
            }
        });
    }

    initStaggerAnimations();

    // Fallback safety check to guarantee nothing is ever left stuck invisible
    setTimeout(() => {
        document.querySelectorAll('.reveal-card').forEach(card => {
            const rect = card.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0 && !card.classList.contains('is-visible')) {
                card.classList.add('is-visible');
            }
        });
    }, 400);
});
