(() => {
  'use strict';

  /* Reviews slider: one card on mobile, two from 768px. Uses Swiper (loaded from cdnjs). */
  const init = () => {
    if (typeof window.Swiper !== 'function') {
      return;
    }

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    document.querySelectorAll('[data-rr-reviews-slider]').forEach((slider) => {
      const viewport = slider.querySelector('.swiper');
      if (!viewport || viewport.swiper) {
        return;
      }

      const count = viewport.querySelectorAll('.swiper-slide').length;

      new window.Swiper(viewport, {
        slidesPerView: 1,
        spaceBetween: 18,
        speed: reduceMotion ? 0 : 550,
        grabCursor: true,
        watchOverflow: true,
        keyboard: { enabled: true, onlyInViewport: true },
        a11y: {
          enabled: true,
          prevSlideMessage: 'Previous review',
          nextSlideMessage: 'Next review',
          paginationBulletMessage: 'Go to review {{index}}',
        },
        navigation: {
          prevEl: slider.querySelector('.rr-reviews-slider__prev'),
          nextEl: slider.querySelector('.rr-reviews-slider__next'),
        },
        pagination: {
          el: slider.querySelector('.rr-reviews-slider__pagination'),
          clickable: true,
          // Keeps the dots compact once there are many reviews.
          dynamicBullets: count > 6,
          dynamicMainBullets: 3,
        },
        breakpoints: {
          768: { slidesPerView: 2, spaceBetween: 22 },
        },
      });
    });
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
