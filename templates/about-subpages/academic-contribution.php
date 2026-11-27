<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main class="ravirao-homepage rr-about-academic-page">
  <section class="rr-academic-hero rr-section-soft" aria-labelledby="rr-academic-title">
    <div class="rr-academic-hero-inner rr-container">
      <div class="rr-academic-hero-copy rr-reveal rr-reveal-up">
        <p class="rr-about-dr-eyebrow">Learning with Dr. Ravi Rao</p>
        <h1 id="rr-academic-title">Astrology Courses, Online Training &amp; Workshops</h1>
        <p>Unlock the timeless science of astrology with Dr. Ravi Rao. Learn predictive methods, cosmic insights, and practical techniques through programs for beginners and advanced seekers.</p>
      </div>
      <a class="rr-academic-platform rr-reveal rr-reveal-right" href="https://onlineastrologyclasses.com/" target="_blank" rel="noopener noreferrer" aria-label="Visit OnlineAstrologyClasses.com">
        <img src="<?php echo esc_url(content_url('/uploads/2025/06/Astro-class-final-logo.jpg')); ?>" alt="OnlineAstrologyClasses.com">
        <span>Explore the online academy <span aria-hidden="true">↗</span></span>
      </a>
    </div>
  </section>

  <section class="rr-academic-programs" aria-labelledby="rr-academic-programs-title">
    <div class="rr-academic-programs-inner rr-container">
      <header class="rr-academic-programs-heading rr-reveal rr-reveal-up">
        <p class="rr-about-dr-eyebrow">Two ways to learn</p>
        <h2 id="rr-academic-programs-title">Build your knowledge at your pace</h2>
      </header>
      <div class="rr-academic-program-grid">
        <article class="rr-academic-program rr-reveal rr-reveal-up">
          <span class="rr-academic-program-number" aria-hidden="true">01</span>
          <div class="rr-academic-program-content">
            <h3>Online Courses</h3>
            <p>Interactive online training by Dr. Ravi Rao, delivered through OnlineAstrologyClasses.com, his official global academy. Learn astrology in English, Hindi, and Spanish, with Sanskrit, Russian, Tamil, and Bengali programs launching soon. Study from anywhere in the world.</p>
            <a class="rr-academic-action" href="https://onlineastrologyclasses.com/" target="_blank" rel="noopener noreferrer"><span class="rr-academic-action-label">Explore online courses</span> <span aria-hidden="true">↗</span></a>
          </div>
        </article>
        <article class="rr-academic-program rr-reveal rr-reveal-up">
          <span class="rr-academic-program-number" aria-hidden="true">02</span>
          <div class="rr-academic-program-content">
            <h3>Global Workshops</h3>
            <p>Join intensive full-day workshops with Dr. Rao for groups of 50 or 100+ members. Get certified, build your skills, and connect with a worldwide community of passionate learners.</p>
            <a class="rr-academic-action" href="<?php echo esc_url(home_url('/#business-enquiry')); ?>"><span class="rr-academic-action-label">Enquire about a workshop</span> <span aria-hidden="true">↗</span></a>
          </div>
        </article>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>