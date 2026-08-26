import './bootstrap';

/**
 * Global Staggered Scroll Reveal Animation System (Vanilla JS + IntersectionObserver)
 */
document.addEventListener('DOMContentLoaded', () => {
    const initStaggerObserver = () => {
        const staggerWrappers = document.querySelectorAll('.stagger-wrapper');
        if (!staggerWrappers.length) return;

        if (!('IntersectionObserver' in window)) {
            // Fallback for browsers without IntersectionObserver
            document.querySelectorAll('.reveal-card').forEach(card => card.classList.add('is-visible'));
            return;
        }

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -40px 0px',
            threshold: 0.08
        };

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const wrapper = entry.target;
                    const cards = wrapper.querySelectorAll('.reveal-card:not(.is-visible)');
                    
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('is-visible');
                        }, index * 120);
                    });

                    // Disconnect the observer for this container after it reveals
                    obs.unobserve(wrapper);
                }
            });
        }, observerOptions);

        staggerWrappers.forEach(wrapper => observer.observe(wrapper));
    };

    initStaggerObserver();
    window.initStaggerObserver = initStaggerObserver;
});
