(() => {
    'use strict';

    document.querySelectorAll('.rr-workshops-list').forEach((list) => {
        const triggers = [...list.querySelectorAll('.rr-workshop-trigger')];
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        const setExpanded = (trigger, expanded) => {
            const panel = document.getElementById(trigger.getAttribute('aria-controls'));
            if (!panel) return;

            trigger.setAttribute('aria-expanded', String(expanded));

            if (expanded) {
                panel.hidden = false;
                panel.style.height = '0px';

                if (reduceMotion) {
                    panel.style.height = 'auto';
                    return;
                }

                requestAnimationFrame(() => {
                    panel.style.height = `${panel.scrollHeight}px`;
                });
                return;
            }

            if (panel.hidden) return;

            if (reduceMotion) {
                panel.hidden = true;
                panel.style.height = '';
                return;
            }

            panel.style.height = `${panel.scrollHeight}px`;
            requestAnimationFrame(() => {
                panel.style.height = '0px';
            });
        };

        triggers.forEach((trigger) => {
            const panel = document.getElementById(trigger.getAttribute('aria-controls'));
            if (!panel) return;

            panel.addEventListener('transitionend', (event) => {
                if (event.propertyName !== 'height') return;

                if (trigger.getAttribute('aria-expanded') === 'true') {
                    panel.style.height = 'auto';
                } else {
                    panel.hidden = true;
                    panel.style.height = '';
                }
            });

            trigger.addEventListener('click', () => {
                const willExpand = trigger.getAttribute('aria-expanded') !== 'true';

                triggers.forEach((otherTrigger) => {
                    if (otherTrigger !== trigger) setExpanded(otherTrigger, false);
                });

                setExpanded(trigger, willExpand);
            });
        });
    });
})();