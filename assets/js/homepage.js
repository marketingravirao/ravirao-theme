// Extracted homepage script: block 1
const slider = document.getElementById('heroSlider');
const slides = slider.querySelectorAll('.hero-slide');
const dotsContainer = slider.querySelector('.hero-slider-dots');

slides.forEach((slide, i) => {
  const dot = document.createElement('div');
  dot.classList.add('hero-slider-dot');
  if (i === 0) dot.classList.add('active');
  dot.onclick = () => {
    goToSlide(i);
    resetAutoSlide();
  };
  dotsContainer.appendChild(dot);
});
const dots = dotsContainer.querySelectorAll('.hero-slider-dot');
let current = 0, interval;
function goToSlide(idx) {
  slides[current].classList.remove('active');
  dots[current].classList.remove('active');
  current = idx;
  slides[current].classList.add('active');
  dots[current].classList.add('active');
}
function nextSlide() {
  goToSlide((current + 1) % slides.length);
}
function resetAutoSlide() {
  clearInterval(interval);
  interval = setInterval(nextSlide, 4600);
}
resetAutoSlide();

// Extracted homepage script: block 2
document.addEventListener('DOMContentLoaded', function() {
  const track = document.querySelector('.industry-section-premium .carousel-track');
  if(track) {
    track.addEventListener('mouseenter', function(){ track.style.animationPlayState = 'paused'; });
    track.addEventListener('mouseleave', function(){ track.style.animationPlayState = 'running'; });
  }
});

// Extracted homepage script: block 3
document.addEventListener('DOMContentLoaded', function() {
  const track = document.querySelector('.infinite-logo-carousel .carousel-track');
  if(track) {
    track.addEventListener('mouseenter', function(){ track.style.animationPlayState = 'paused'; });
    track.addEventListener('mouseleave', function(){ track.style.animationPlayState = 'running'; });
  }
});

// Extracted homepage script: block 4
document.addEventListener('DOMContentLoaded', function() {
  const track = document.querySelector('.elements-carousel-track');
  if(track) {
    track.addEventListener('mouseenter', function(){ track.style.animationPlayState = 'paused'; });
    track.addEventListener('mouseleave', function(){ track.style.animationPlayState = 'running'; });
  }
});
