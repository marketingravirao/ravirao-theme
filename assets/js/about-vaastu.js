(() => {
    'use strict';

    document.documentElement.classList.add('js');

    document.querySelectorAll('[data-vaastu-more]').forEach((button) => {
        const contentId = button.getAttribute('aria-controls');
        const content = contentId ? document.getElementById(contentId) : null;
        const label = button.querySelector('[data-vaastu-more-label]');

        if (!content || !label) {
            return;
        }

        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', String(!expanded));
            content.classList.toggle('open', !expanded);
            label.textContent = expanded ? 'Read more' : 'Read less';
        });
    });

    const illustrations = document.querySelectorAll('.rr-about-vaastu-design .av, .rr-about-vaastu-design .av-i');

    if (!('IntersectionObserver' in window)) {
        illustrations.forEach((illustration) => illustration.classList.add('on'));
        return;
    }

    const illustrationObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('on');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    illustrations.forEach((illustration) => illustrationObserver.observe(illustration));
})();
