(() => {
    'use strict';

    const headerGroup = document.querySelector('.site-header-group');
    const siteHeader = headerGroup?.querySelector('.site-header');

    if (headerGroup && siteHeader) {
        const getHeaderRevealThreshold = () => window.innerHeight;
        let scrollFrame = null;

        const finishHeaderTransition = () => {
            if (window.scrollY < getHeaderRevealThreshold()) {
                headerGroup.classList.remove('is-fixed', 'is-animated', 'is-visible', 'is-hiding');
                headerGroup.style.height = '';
            }
        };

        const updateHeaderVisibility = () => {
            const shouldShowHeader = window.scrollY >= getHeaderRevealThreshold();
            const isFixed = headerGroup.classList.contains('is-fixed');

            if (isFixed && window.scrollY <= 1) {
                headerGroup.classList.remove('is-fixed', 'is-animated', 'is-visible', 'is-hiding');
                headerGroup.style.height = '';
                scrollFrame = null;
                return;
            }

            if (shouldShowHeader && !isFixed) {
                headerGroup.style.height = `${siteHeader.offsetHeight}px`;
                headerGroup.classList.add('is-fixed');
                window.requestAnimationFrame(() => {
                    if (window.scrollY >= getHeaderRevealThreshold()) {
                        headerGroup.classList.add('is-animated', 'is-visible');
                    } else {
                        finishHeaderTransition();
                    }
                });
            } else if (shouldShowHeader) {
                headerGroup.classList.remove('is-hiding');
                headerGroup.classList.add('is-visible');
            } else if (isFixed && headerGroup.classList.contains('is-visible')) {
                headerGroup.classList.remove('is-visible');
                headerGroup.classList.add('is-hiding');
                window.setTimeout(finishHeaderTransition, 550);
            } else if (isFixed && !headerGroup.classList.contains('is-hiding')) {
                finishHeaderTransition();
            }

            scrollFrame = null;
        };

        siteHeader.addEventListener('transitionend', event => {
            if (event.target === siteHeader && event.propertyName === 'transform') {
                finishHeaderTransition();
            }
        });

        window.addEventListener('scroll', () => {
            if (scrollFrame === null) {
                scrollFrame = window.requestAnimationFrame(updateHeaderVisibility);
            }
        }, { passive: true });

        window.addEventListener('resize', () => {
            if (headerGroup.classList.contains('is-fixed')) {
                headerGroup.style.height = `${siteHeader.offsetHeight}px`;
            }
            updateHeaderVisibility();
        });
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

    function updateSubmenuHeight(submenu) {
        if (!submenu) return;

        submenu.style.setProperty('--rr-mobile-submenu-height', `${submenu.scrollHeight}px`);
        const parentSubmenu = submenu.parentElement?.closest('.sub-menu');
        if (parentSubmenu) updateSubmenuHeight(parentSubmenu);
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
        updateSubmenuHeight(submenu);

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
            updateSubmenuHeight(submenu);
        });
    });

    window.addEventListener('resize', () => {
        navigation.querySelectorAll('.sub-menu').forEach(updateSubmenuHeight);
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