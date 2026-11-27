(() => {
    const tabList = document.querySelector('.rr-brand-tabs');

    if (!tabList) return;

    const tabs = [...tabList.querySelectorAll('[role="tab"]')];
    const panels = [...document.querySelectorAll('.rr-brand-logos-grid[role="tabpanel"]')];

    function activateTab(tab, moveFocus = false) {
        const target = tab.dataset.tab;

        tabs.forEach((item) => {
            const isActive = item === tab;
            item.classList.toggle('is-active', isActive);
            item.setAttribute('aria-selected', String(isActive));
            item.tabIndex = isActive ? 0 : -1;
        });

        panels.forEach((panel) => {
            panel.hidden = panel.dataset.panel !== target;
        });

        if (moveFocus) tab.focus();
    }

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => activateTab(tab));
        tab.addEventListener('keydown', (event) => {
            let nextIndex = index;

            if (event.key === 'ArrowRight') nextIndex = (index + 1) % tabs.length;
            else if (event.key === 'ArrowLeft') nextIndex = (index - 1 + tabs.length) % tabs.length;
            else if (event.key === 'Home') nextIndex = 0;
            else if (event.key === 'End') nextIndex = tabs.length - 1;
            else return;

            event.preventDefault();
            activateTab(tabs[nextIndex], true);
        });
    });
})();