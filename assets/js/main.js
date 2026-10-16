(() => {
    'use strict';

    const headerGroup = document.querySelector('.site-header-group');
    const headerGroupInner = headerGroup?.querySelector('.site-header-group-inner');

    if (headerGroup && headerGroupInner) {
        let scrollFrame = null;
        let transitionTimer = null;

        const finishHeaderTransition = () => {
            window.clearTimeout(transitionTimer);

            if (window.scrollY >= window.innerHeight * 0.2) {
                headerGroup.classList.remove('is-scroll-hidden');
            } else {
                headerGroup.classList.remove('is-scrolled', 'is-scroll-hidden');
            }
        };

        const updateHeaderVisibility = () => {
            headerGroup.style.height = `${headerGroupInner.offsetHeight}px`;
            const shouldShowHeader = window.scrollY >= window.innerHeight * 0.2;
            const isShown = headerGroup.classList.contains('is-scrolled');

            if (shouldShowHeader && !isShown) {
                headerGroup.classList.add('is-scrolled', 'is-scroll-hidden');
                void headerGroupInner.offsetHeight;
                window.requestAnimationFrame(() => {
                    if (window.scrollY >= window.innerHeight * 0.2) {
                        headerGroup.classList.remove('is-scroll-hidden');
                    }
                });
                transitionTimer = window.setTimeout(finishHeaderTransition, 350);
            } else if (shouldShowHeader) {
                headerGroup.classList.remove('is-scroll-hidden');
            } else if (isShown && !headerGroup.classList.contains('is-scroll-hidden')) {
                headerGroup.classList.add('is-scroll-hidden');
                transitionTimer = window.setTimeout(finishHeaderTransition, 350);
            }

            scrollFrame = null;
        };

        headerGroupInner.addEventListener('transitionend', event => {
            if (event.target === headerGroupInner && event.propertyName === 'transform') {
                finishHeaderTransition();
            }
        });

        window.addEventListener('scroll', () => {
            if (scrollFrame === null) {
                scrollFrame = window.requestAnimationFrame(updateHeaderVisibility);
            }
        }, { passive: true });

        window.addEventListener('resize', updateHeaderVisibility);
        updateHeaderVisibility();
    }

    const button = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('#primary-navigation');

    if (!button || !navigation) {
        return;
    }

    function closeSubmenus() {
        navigation.querySelectorAll('.submenu-toggle').forEach(submenuButton => {
            submenuButton.setAttribute('aria-expanded', 'false');
            submenuButton.closest('li').classList.remove('submenu-open');
        });
    }

    button.addEventListener('click', () => {
        const isOpen = button.getAttribute('aria-expanded') === 'true';

        button.setAttribute('aria-expanded', String(!isOpen));
        navigation.classList.toggle('is-open', !isOpen);

        if (isOpen) {
            closeSubmenus();
        }
    });

    navigation.querySelectorAll('li.menu-item-has-children').forEach((item, index) => {
        const submenu = item.querySelector(':scope > .sub-menu');
        const link = item.querySelector(':scope > a');

        if (!submenu || !link) {
            return;
        }

        if (!submenu.id) {
            submenu.id = `primary-submenu-${index + 1}`;
        }

        const submenuButton = document.createElement('button');
        submenuButton.className = 'submenu-toggle';
        submenuButton.type = 'button';
        submenuButton.setAttribute('aria-expanded', 'false');
        submenuButton.setAttribute('aria-controls', submenu.id);
        submenuButton.setAttribute('aria-label', `Toggle submenu for ${link.textContent.trim()}`);
        item.insertBefore(submenuButton, submenu);

        submenuButton.addEventListener('click', () => {
            const isOpen = submenuButton.getAttribute('aria-expanded') === 'true';

            submenuButton.setAttribute('aria-expanded', String(!isOpen));
            item.classList.toggle('submenu-open', !isOpen);
        });
    });

    document.addEventListener('keydown', (event) => {
        const isOpen = button.getAttribute('aria-expanded') === 'true';

        if (event.key === 'Escape' && isOpen) {
            button.setAttribute('aria-expanded', 'false');
            navigation.classList.remove('is-open');
            button.focus();
            return;
        }

        if (event.key === 'Escape') {
            const openSubmenuButtons = navigation.querySelectorAll('.submenu-toggle[aria-expanded="true"]');
            const openSubmenuButton = openSubmenuButtons[openSubmenuButtons.length - 1];

            if (openSubmenuButton) {
                openSubmenuButton.setAttribute('aria-expanded', 'false');
                openSubmenuButton.closest('li').classList.remove('submenu-open');
                openSubmenuButton.focus();
            }
        }
    });

    navigation.addEventListener('click', (event) => {
        if (!(event.target instanceof Element) || event.target.closest('.submenu-toggle')) {
            return;
        }

        if (event.target.closest('a') && window.matchMedia('(max-width: 900px)').matches) {
            button.setAttribute('aria-expanded', 'false');
            navigation.classList.remove('is-open');
            closeSubmenus();
        }
    });

    window.matchMedia('(min-width: 901px)').addEventListener('change', event => {
        if (event.matches) {
            button.setAttribute('aria-expanded', 'false');
            navigation.classList.remove('is-open');
            closeSubmenus();
        }
    });
})();

(() => {
    const selector = 'body.page-id-6851 .event-title-container';
    const labels = ['Sunrise', 'Sunset', 'Moonrise'];

    function updateEventTimes() {
        document.querySelectorAll(selector).forEach(container => {
            if (container.querySelector('.event-times-table')) return;

            const images = [...container.querySelectorAll(':scope > img')];
            if (!images.length) return;

            const table = document.createElement('div');
            table.className = 'event-times-table';

            images.forEach((img, index) => {
                const next = img.nextSibling;
                const time = next?.nodeType === Node.TEXT_NODE
                    ? next.textContent.trim()
                    : '';

                const row = document.createElement('div');
                row.className = 'event-times-row';

                const info = document.createElement('div');
                info.className = 'event-times-info';

                const label = document.createElement('span');
                label.className = 'event-times-label';
                label.textContent = labels[index] || 'Event';

                const value = document.createElement('span');
                value.className = 'event-times-value';
                value.textContent = time || '—';

                info.append(img, label);
                row.append(info, value);
                table.append(row);
            });

            container.replaceChildren(table);
        });
    }

    if (!document.body.classList.contains('page-id-6851')) return;

    updateEventTimes();

    const observer = new MutationObserver(mutations => {
        const needsUpdate = mutations.some(mutation =>
            mutation.type === 'childList' &&
            [...mutation.addedNodes].some(node =>
                node.nodeType === Node.ELEMENT_NODE &&
                (
                    node.matches?.(selector) ||
                    node.querySelector?.(selector) ||
                    node.matches?.(`${selector} > img`)
                )
            )
        );

        if (needsUpdate) updateEventTimes();
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
})();