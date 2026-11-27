(() => {
    'use strict';

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const revealTargets = document.querySelectorAll('.rr-reveal, [data-reveal], .rr-reveal-group, [data-reveal-group], .rr-hero-title, .rr-hero-worded');

    if (!revealTargets.length || !window.gsap || !window.ScrollTrigger) {
        return;
    }

    const setupHeroWordAnimation = () => {
        document.querySelectorAll('.rr-hero-title, .rr-hero-worded').forEach((heading) => {
            if (heading.dataset.rrWordsReady === 'true') return;

            const text = heading.textContent.trim();
            const words = text.split(/\s+/).filter(Boolean);

            if (!words.length) return;

            heading.setAttribute('aria-label', text);
            heading.replaceChildren(...words.flatMap((word) => {
                const wrap = document.createElement('span');
                wrap.className = 'rr-hero-word-wrap';
                wrap.setAttribute('aria-hidden', 'true');

                const wordNode = document.createElement('span');
                wordNode.className = 'rr-hero-word';
                wordNode.textContent = word;
                wrap.appendChild(wordNode);

                return [wrap, document.createTextNode(' ')];
            }));

            heading.dataset.rrWordsReady = 'true';
        });
    };

    setupHeroWordAnimation();

    if (reduceMotion) {
        return;
    }

    window.gsap.registerPlugin(window.ScrollTrigger);

    const revealFrom = (direction = 'up') => {
        switch (direction) {
            case 'left':
                return { x: -52, y: 0, autoAlpha: 0 };
            case 'right':
                return { x: 52, y: 0, autoAlpha: 0 };
            case 'scale':
                return { x: 0, y: 24, scale: 0.94, autoAlpha: 0 };
            default:
                return { x: 0, y: 42, autoAlpha: 0 };
        }
    };

    const getDirection = (item) => {
        const datasetDirection = item.dataset.reveal || '';
        if (datasetDirection) {
            return datasetDirection;
        }

        if (item.classList.contains('rr-reveal-left')) return 'left';
        if (item.classList.contains('rr-reveal-right')) return 'right';
        if (item.classList.contains('rr-reveal-scale')) return 'scale';

        return 'up';
    };

    document.querySelectorAll('.rr-reveal, [data-reveal]').forEach((item) => {
        const direction = getDirection(item);

        window.gsap.fromTo(
            item,
            revealFrom(direction),
            {
                x: 0,
                y: 0,
                scale: 1,
                autoAlpha: 1,
                duration: 0.9,
                ease: 'power3.out',
                clearProps: 'transform,opacity,visibility',
                scrollTrigger: {
                    trigger: item,
                    start: 'top 86%',
                    once: true
                }
            }
        );
    });

    document.querySelectorAll('.rr-reveal-group, [data-reveal-group]').forEach((group) => {
        const items = [...group.querySelectorAll('.rr-reveal, [data-reveal]')];
        const animatedItems = items.length ? items : [...group.children];

        if (!animatedItems.length) {
            return;
        }

        window.gsap.fromTo(
            animatedItems,
            { y: 38, scale: 0.97, autoAlpha: 0 },
            {
                y: 0,
                scale: 1,
                autoAlpha: 1,
                duration: 0.78,
                stagger: 0.12,
                ease: 'power3.out',
                clearProps: 'transform,opacity,visibility',
                scrollTrigger: {
                    trigger: group,
                    start: 'top 84%',
                    once: true
                }
            }
        );
    });

    document.querySelectorAll('.rr-hero-title, .rr-hero-worded').forEach((heading) => {
        const words = heading.querySelectorAll('.rr-hero-word');
        if (!words.length) return;

        window.gsap.fromTo(
            words,
            { yPercent: 110, opacity: 0 },
            {
                yPercent: 0,
                opacity: 1,
                duration: 0.82,
                stagger: 0.04,
                ease: 'power3.out',
                delay: 0.12,
                clearProps: 'transform,opacity'
            }
        );
    });
})();
