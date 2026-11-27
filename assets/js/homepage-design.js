'use strict';
/* --- video: load the YouTube player only on click (privacy-friendly nocookie embed) --- */
var playButton = document.getElementById('play-ravi-video');
if (playButton) playButton.addEventListener('click', function () {
  var frame = this.parentElement, iframe = document.createElement('iframe');
  iframe.src = 'https://www.youtube-nocookie.com/embed/KdKxlitTMsU?autoplay=1&rel=0';
  iframe.title = 'Dr. Ravi Rao — featured video';
  iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
  iframe.allowFullscreen = true;
  iframe.referrerPolicy = 'strict-origin-when-cross-origin';
  iframe.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:0';
  frame.appendChild(iframe); this.remove();
});
(function () {
  var dl = function (o) { (window.dataLayer = window.dataLayer || []).push(o); };
  /* --- mobile menu --- */
  var mb = document.querySelector('.menu-btn'), menu = document.getElementById('site-menu');
  if (mb && menu) {
    mb.addEventListener('click', function () { var o = menu.classList.toggle('open'); mb.setAttribute('aria-expanded', o); mb.textContent = o ? 'Close' : 'Menu'; });
    menu.addEventListener('click', function (e) { if (e.target.tagName === 'A') { menu.classList.remove('open'); mb.setAttribute('aria-expanded', 'false'); mb.textContent = 'Menu'; } });
  }
  /* --- quick-contact button appears after the hero --- */
  var wa = document.querySelector('.wa-float');
  if (wa) { var t = function () { wa.classList.toggle('show', window.scrollY > 760); }; window.addEventListener('scroll', t, { passive: true }); t(); }
  /* --- CTA click tracking (GTM / GA4 ready: dataLayer event "cta_click") --- */
  document.addEventListener('click', function (e) { var a = e.target.closest('[data-cta]'); if (a) dl({ event: 'cta_click', cta: a.getAttribute('data-cta') }); });
  /* --- consultation form --- */
  var f = document.getElementById('consultation-form'); if (!f) return;
  var q = new URLSearchParams(location.search);
  ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid'].forEach(function (k) { if (f.elements[k] && q.get(k)) f.elements[k].value = q.get(k); });
  f.elements.page_url.value = location.href.split('#')[0];
  var pre = (q.get('service') || '').toLowerCase();
  if (pre) Array.prototype.forEach.call(f.elements.service.options, function (o) { if (o.text.toLowerCase().indexOf(pre) === 0) f.elements.service.value = o.value || o.text; });
  var st = f.querySelector('.form-status');
  function say(msg, err) { st.textContent = msg; st.className = 'form-status show' + (err ? ' err' : ''); }
  f.addEventListener('submit', function (e) {
    e.preventDefault();
    if (f.elements.website.value) return;                       /* honeypot */
    if (!f.checkValidity()) { f.reportValidity(); return; }
    var d = {}; new FormData(f).forEach(function (v, k) { d[k] = v; });
    dl({ event: 'lead_submit', form: 'homepage_consultation', service: d.service || '' });
    var ep = f.getAttribute('data-endpoint'), btn = f.querySelector('button[type=submit]');
    if (ep) {                                                    /* production: POST to the CRM / form handler */
      btn.disabled = true;
      fetch(ep, { method: 'POST', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify(d) })
        .then(function (r) { if (!r.ok) throw new Error(r.status); f.reset(); say('Thank you. Your request has been received and the team will contact you shortly.'); })
        .catch(function () { say('Sorry, the request could not be sent. Please call +91 90996 08886 or write to office@ravirao.com.', true); })
        .then(function () { btn.disabled = false; });
    } else {                                                     /* until an endpoint is configured: prepare an e-mail */
      var body = ['Name: ' + d.name, 'Phone / WhatsApp: ' + d.phone, 'Email: ' + (d.email || '-'), 'Consultation type: ' + (d.service || '-'), '', d.message || ''].join('\n');
      window.location.href = 'mailto:office@ravirao.com?subject=' + encodeURIComponent('Consultation request: ' + (d.service || 'General')) + '&body=' + encodeURIComponent(body);
      say('Your e-mail application should open with the request prepared. If it does not, write to office@ravirao.com or message the office on WhatsApp.');
    }
  });
})();
