(() => {
  'use strict';

  const page = document.querySelector('.ravirao-homepage');
  if (!page) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const gsap = window.gsap;
  const slides = [...page.querySelectorAll('.hero-slide')];
  const dotsContainer = page.querySelector('.hero-slider-dots');
  let currentSlide = 0;
  let slideTimer;

  function setSlide(index) {
    const previous = slides[currentSlide];
    const next = slides[index];

    if (!next || index === currentSlide) return;

    previous?.classList.remove('active');
    next.classList.add('active');
    dotsContainer?.querySelectorAll('.hero-slider-dot').forEach((dot, dotIndex) => {
      const isCurrent = dotIndex === index;
      dot.classList.toggle('active', isCurrent);
      dot.setAttribute('aria-pressed', String(isCurrent));
    });
    currentSlide = index;

    if (gsap && !reduceMotion) {
      gsap.fromTo(
        next.querySelector('.hero-slide-content'),
        { y: 24, opacity: 0 },
        { y: 0, opacity: 1, duration: 0.75, ease: 'power3.out', clearProps: 'all' }
      );
      gsap.fromTo(
        next.querySelectorAll('.hero-word'),
        { yPercent: 110, opacity: 0 },
        { yPercent: 0, opacity: 1, duration: 0.7, stagger: 0.035, ease: 'power3.out', delay: 0.08 }
      );
    }
  }

  if (slides.length > 1 && dotsContainer) {
    slides.forEach((slide, index) => {
      const dot = document.createElement('button');
      dot.className = 'hero-slider-dot';
      dot.type = 'button';
      dot.setAttribute('aria-label', `Show slide ${index + 1} of ${slides.length}`);
      dot.setAttribute('aria-pressed', String(index === 0));
      dot.classList.toggle('active', index === 0);
      dot.addEventListener('click', () => {
        setSlide(index);
        restartSlideTimer();
      });
      dotsContainer.appendChild(dot);
    });

    function restartSlideTimer() {
      window.clearInterval(slideTimer);
      if (!reduceMotion && !document.hidden) {
        slideTimer = window.setInterval(() => {
          setSlide((currentSlide + 1) % slides.length);
        }, 5200);
      }
    }

    const slider = page.querySelector('.hero-slider-section');
    slider?.addEventListener('mouseenter', () => window.clearInterval(slideTimer));
    slider?.addEventListener('mouseleave', restartSlideTimer);
    slider?.addEventListener('focusin', () => window.clearInterval(slideTimer));
    slider?.addEventListener('focusout', restartSlideTimer);
    document.addEventListener('visibilitychange', restartSlideTimer);
    restartSlideTimer();
  }

  page.querySelectorAll('.hero-title').forEach((heading) => {
    if (heading.dataset.wordsReady) return;

    const text = heading.textContent.trim();
    const words = text.split(/\s+/);
    heading.setAttribute('aria-label', text);
    heading.replaceChildren(...words.flatMap((word, index) => {
      const wrapper = document.createElement('span');
      wrapper.className = 'hero-word-wrap';
      wrapper.setAttribute('aria-hidden', 'true');

      const wordElement = document.createElement('span');
      wordElement.className = 'hero-word';
      wordElement.textContent = word;
      wrapper.appendChild(wordElement);
      return index < words.length - 1
        ? [wrapper, document.createTextNode(' ')]
        : [wrapper];
    }));
    heading.dataset.wordsReady = 'true';
  });

  page.querySelectorAll('.industry-section-premium .carousel-track, .infinite-logo-carousel .carousel-track, .elements-carousel-track')
    .forEach((track) => {
      track.addEventListener('mouseenter', () => {
        track.style.animationPlayState = 'paused';
      });
      track.addEventListener('mouseleave', () => {
        track.style.animationPlayState = 'running';
      });
      track.addEventListener('focusin', () => {
        track.style.animationPlayState = 'paused';
      });
      track.addEventListener('focusout', () => {
        track.style.animationPlayState = 'running';
      });
    });

  page.addEventListener('click', (event) => {
    const anchor = event.target.closest('a[href^="#"]');
    if (!anchor) return;

    const target = page.querySelector(anchor.getAttribute('href'));
    if (!target) return;

    event.preventDefault();
    target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
  });

  if (!gsap || !window.ScrollTrigger || reduceMotion) return;

  gsap.registerPlugin(window.ScrollTrigger);

  const animatedItems = page.querySelectorAll([
    '.ravi-content-wrapper-modern',
    '.industry-heading-bar',
    '.vaastu-industry-card-outer',
    '.muhurtha-section-heading',
    '.vaastu-service-card',
    '.testimonial-section-main-heading',
    '.testimonial-card-sketch',
    '.five-elements-carousel-heading',
    '.vaastu-panchmaha-section',
    '.vaastu-heading-section',
    '.vaastu-blogs-title',
    '.vaastu-blog-card',
    '.business-enquiry-form'
  ].join(','));

  window.ScrollTrigger.batch(animatedItems, {
    start: 'top 88%',
    once: true,
    onEnter: (batch) => {
      gsap.fromTo(
        batch,
        { y: 34, opacity: 0 },
        {
          y: 0,
          opacity: 1,
          duration: 0.75,
          stagger: 0.1,
          ease: 'power3.out',
          clearProps: 'transform,opacity'
        }
      );
    }
  });

  page.querySelectorAll('.muhurtha-img-main, .muhurtha-img-hover').forEach((image) => {
    gsap.fromTo(
      image,
      { scale: 1.08 },
      {
        scale: 1,
        ease: 'none',
        scrollTrigger: {
          trigger: image,
          start: 'top bottom',
          end: 'bottom top',
          scrub: 0.7
        }
      }
    );
  });

  page.querySelectorAll('.hero-title').forEach((heading) => {
    gsap.fromTo(
      heading.querySelectorAll('.hero-word'),
      { yPercent: 110, opacity: 0 },
      {
        yPercent: 0,
        opacity: 1,
        duration: 0.85,
        stagger: 0.035,
        ease: 'power3.out',
        delay: 0.25
      }
    );
  });
})();
