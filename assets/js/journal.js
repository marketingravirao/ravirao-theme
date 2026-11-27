(() => {
  'use strict';

  let videoDialog;

  const createVideoDialog = () => {
    const dialog = document.createElement('dialog');
    dialog.className = 'rrj-video-dialog';
    dialog.setAttribute('aria-label', 'Media viewer');

    const panel = document.createElement('div');
    panel.className = 'rrj-video-dialog__panel';

    const player = document.createElement('div');
    player.className = 'rrj-video-dialog__player';

    const close = document.createElement('button');
    close.className = 'rrj-video-dialog__close';
    close.type = 'button';
    close.setAttribute('aria-label', 'Close media');
    close.textContent = '×';
    close.addEventListener('click', () => dialog.close());

    panel.append(player, close);
    dialog.append(panel);
    dialog.addEventListener('click', (event) => {
      if (event.target === dialog) {
        dialog.close();
      }
    });
    dialog.addEventListener('close', () => {
      player.replaceChildren();
      dialog.classList.remove('rrj-video-dialog--image');
    });
    document.body.append(dialog);

    return { dialog, player };
  };

  document.addEventListener('click', (event) => {
    if (!(event.target instanceof Element)) {
      return;
    }

    const button = event.target.closest('[data-rrj-video-embed], [data-rrj-video-file], [data-rrj-image-popup]');
    if (!button) {
      return;
    }

    const embedUrl = button.dataset.rrjVideoEmbed;
    const fileUrl = button.dataset.rrjVideoFile;
    const imageUrl = button.dataset.rrjImagePopup;
    if (!embedUrl && !fileUrl && !imageUrl) {
      return;
    }

    event.preventDefault();
    if (!videoDialog) {
      videoDialog = createVideoDialog();
    }

    const title = button.dataset.rrjVideoTitle || button.dataset.rrjImageAlt || 'Video';
    videoDialog.dialog.setAttribute('aria-label', `${imageUrl ? 'Image viewer' : 'Video player'}: ${title}`);

    if (imageUrl) {
      videoDialog.dialog.classList.add('rrj-video-dialog--image');
      const image = document.createElement('img');
      image.src = imageUrl;
      image.alt = button.dataset.rrjImageAlt || title;
      image.decoding = 'async';
      videoDialog.player.replaceChildren(image);
    } else if (embedUrl) {
      videoDialog.dialog.classList.remove('rrj-video-dialog--image');
      const iframe = document.createElement('iframe');
      const url = new URL(embedUrl, window.location.href);
      url.searchParams.set('autoplay', '1');
      iframe.src = url.href;
      iframe.title = title;
      iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
      iframe.allowFullscreen = true;
      iframe.referrerPolicy = 'strict-origin-when-cross-origin';
      videoDialog.player.replaceChildren(iframe);
    } else {
      videoDialog.dialog.classList.remove('rrj-video-dialog--image');
      const video = document.createElement('video');
      video.src = fileUrl;
      video.controls = true;
      video.autoplay = true;
      video.playsInline = true;
      video.preload = 'metadata';
      video.setAttribute('aria-label', title);
      if (button.dataset.rrjVideoPoster) {
        video.poster = button.dataset.rrjVideoPoster;
      }
      videoDialog.player.replaceChildren(video);
    }

    videoDialog.dialog.showModal();
  });

  const form = document.querySelector('[data-rrj-live-filter]');
  if (!form) {
    return;
  }

  const mode = form.dataset.rrjLiveMode;
  const results = document.querySelector('#rrj-live-results');
  const landing = document.querySelector('#rrj-landing-content');
  const status = form.querySelector('[data-rrj-filter-status]');
  if (!results || !status) {
    return;
  }

  let activeRequest = null;
  let searchTimer = null;

  const setStatus = (message, isError = false) => {
    status.textContent = message;
    status.classList.toggle('screen-reader-text', !isError);
    status.classList.toggle('rrj-filter__status--error', isError);
  };

  const filterUrl = () => {
    const url = new URL(form.action, window.location.href);
    const values = new FormData(form);
    ['journal_search', 'j_type', 'j_topic'].forEach((name) => {
      const value = String(values.get(name) || '').trim();
      if (value) {
        url.searchParams.set(name, value);
      } else {
        url.searchParams.delete(name);
      }
    });
    return url;
  };

  const updateForm = (documentFromResponse) => {
    const nextForm = documentFromResponse.querySelector('[data-rrj-live-filter]');
    if (!nextForm) {
      return;
    }

    const nextValues = new FormData(nextForm);
    form.querySelectorAll('input[type="search"]').forEach((input) => {
      input.value = String(nextValues.get(input.name) || '');
    });
    form.querySelectorAll('input[type="radio"]').forEach((input) => {
      input.checked = nextValues.get(input.name) === input.value;
    });
  };

  const showUnfilteredJournal = (url) => {
    if (!landing || landing.childElementCount === 0) {
      window.location.assign(url.href);
      return false;
    }

    if (activeRequest) {
      activeRequest.abort();
      activeRequest = null;
    }
    results.hidden = true;
    landing.hidden = false;
    form.removeAttribute('aria-busy');
    setStatus('');
    window.history.replaceState(null, '', url.href);
    return true;
  };

  const loadResults = async (url) => {
    const hasFilters = ['journal_search', 'j_type', 'j_topic'].some((name) =>
      String(url.searchParams.get(name) || '').trim() !== ''
    );
    if (mode === 'journal' && !hasFilters) {
      showUnfilteredJournal(url);
      return;
    }

    if (activeRequest) {
      activeRequest.abort();
    }

    const controller = new AbortController();
    activeRequest = controller;
    form.setAttribute('aria-busy', 'true');
    setStatus(form.dataset.rrjLoadingText);

    try {
      const response = await fetch(url.href, {
        cache: 'no-store',
        credentials: 'same-origin',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        signal: controller.signal,
      });
      if (!response.ok) {
        throw new Error(`The server returned ${response.status}.`);
      }

      const responseHtml = await response.text();
      const responseDocument = new DOMParser().parseFromString(responseHtml, 'text/html');
      const nextResults = responseDocument.querySelector('#rrj-live-results');
      if (!nextResults) {
        throw new Error('The results section was missing from the response.');
      }

      results.innerHTML = nextResults.innerHTML;
      results.hidden = false;
      if (landing) {
        landing.hidden = true;
      }
      updateForm(responseDocument);
      window.history.replaceState(null, '', url.href);
      const count = Number(results.querySelector('[data-result-count]')?.dataset.resultCount || 0);
      setStatus(`${count} ${count === 1 ? form.dataset.rrjResultSingular : form.dataset.rrjResultsPlural}`);
    } catch (error) {
      if (error.name !== 'AbortError') {
        setStatus(form.dataset.rrjErrorText, true);
      }
    } finally {
      if (activeRequest === controller) {
        activeRequest = null;
        form.removeAttribute('aria-busy');
      }
    }
  };

  form.addEventListener('input', (event) => {
    if (event.target.matches('input[type="search"]')) {
      window.clearTimeout(searchTimer);
      searchTimer = window.setTimeout(() => loadResults(filterUrl()), 300);
    }
  });

  form.addEventListener('change', (event) => {
    if (event.target.matches('input[type="radio"]')) {
      window.clearTimeout(searchTimer);
      loadResults(filterUrl());
    }
  });

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    window.clearTimeout(searchTimer);
    loadResults(filterUrl());
  });

  results.addEventListener('click', (event) => {
    const link = event.target.closest('.rrj-pagination a');
    if (!link || event.defaultPrevented || event.button !== 0 ||
        event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
      return;
    }

    window.clearTimeout(searchTimer);
    const url = new URL(link.href, window.location.href);
    if (url.origin !== window.location.origin) {
      return;
    }

    event.preventDefault();
    loadResults(url);
  });

  window.addEventListener('popstate', () => {
    loadResults(new URL(window.location.href));
  });
})();
