(() => {
  'use strict';

  /* Video: load the YouTube player only on click (privacy-friendly nocookie embed). */
  document.querySelectorAll('[data-tv-youtube]').forEach((poster) => {
    poster.addEventListener('click', () => {
      const iframe = document.createElement('iframe');
      iframe.src = `https://www.youtube-nocookie.com/embed/${encodeURIComponent(poster.dataset.tvYoutube)}?autoplay=1&rel=0`;
      iframe.title = poster.dataset.tvTitle || 'Video';
      iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
      iframe.allowFullscreen = true;
      iframe.referrerPolicy = 'strict-origin-when-cross-origin';
      poster.replaceWith(iframe);
    });
  });
})();
