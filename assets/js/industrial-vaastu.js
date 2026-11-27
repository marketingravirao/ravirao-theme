(() => {
  const sections = document.querySelectorAll('.industrial-vaastu__perspective-section');
  const viewport = window.matchMedia('(max-width: 900px)');
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

  sections.forEach((section) => {
    const more = section.querySelector('.industrial-vaastu__perspective-more');
    const button = section.querySelector('.industrial-vaastu__perspective-toggle');

    if (!more || !button) {
      return;
    }

    let isCollapsible = null;
    let isExpanded = true;

    const setResponsiveState = () => {
      const shouldCollapse = viewport.matches;
      if (shouldCollapse === isCollapsible) {
        return;
      }

      isCollapsible = shouldCollapse;
      if (shouldCollapse) {
        more.classList.add('is-collapsible');
        more.style.height = '0px';
        more.setAttribute('aria-hidden', 'true');
        more.inert = true;
        button.hidden = false;
        button.setAttribute('aria-expanded', 'false');
        button.textContent = 'View more';
        isExpanded = false;
        return;
      }

      more.classList.remove('is-collapsible');
      more.style.removeProperty('height');
      more.removeAttribute('aria-hidden');
      more.inert = false;
      button.hidden = true;
      button.setAttribute('aria-expanded', 'true');
      button.textContent = 'View more';
      isExpanded = true;
    };

    button.addEventListener('click', () => {
      if (!isCollapsible) {
        return;
      }

      isExpanded = !isExpanded;
      button.setAttribute('aria-expanded', String(isExpanded));
      button.textContent = isExpanded ? 'View less' : 'View more';
      more.inert = !isExpanded;
      if (isExpanded) {
        more.removeAttribute('aria-hidden');
      } else {
        more.setAttribute('aria-hidden', 'true');
      }

      const currentHeight = more.getBoundingClientRect().height;
      const targetHeight = isExpanded ? more.scrollHeight : 0;
      if (reducedMotion.matches) {
        more.style.height = isExpanded ? 'auto' : '0px';
        return;
      }

      more.style.height = `${currentHeight}px`;
      more.offsetHeight;
      more.style.height = `${targetHeight}px`;
    });

    more.addEventListener('transitionend', (event) => {
      const fullyExpanded = more.getBoundingClientRect().height + 1 >= more.scrollHeight;
      if (event.target === more && event.propertyName === 'height' && isExpanded && fullyExpanded) {
        more.style.height = 'auto';
      }
    });

    setResponsiveState();
    if (typeof viewport.addEventListener === 'function') {
      viewport.addEventListener('change', setResponsiveState);
    } else {
      viewport.addListener(setResponsiveState);
    }
  });
})();
