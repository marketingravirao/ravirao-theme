<?php
/*
Template Name: About Page (Branded)
Template Post Type: page
*/
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<div class="ravirao-about-page">
  <section class="about-hero" aria-labelledby="about-hero-title">
    <img
      class="about-hero-image"
      src="<?php echo esc_url(content_url('/uploads/2025/07/2B2A4121-scaled.jpg')); ?>"
      alt=""
      fetchpriority="high">
    <div class="about-hero-content">
      <p class="about-eyebrow">About Dr. Ravi Rao</p>
      <h1 id="about-hero-title">Discover Dr. Ravi Rao’s World</h1>
      <p class="about-hero-subtitle">Legacy, Learning &amp; Leadership</p>
    </div>
  </section>

  <section class="about-destinations" aria-labelledby="about-destinations-title">
    <div class="about-section-heading">
      <p class="about-eyebrow">A closer look</p>
      <h2 id="about-destinations-title">Explore the work and ideas</h2>
    </div>
    <div class="about-card-grid">
      <a class="about-card" href="<?php echo esc_url(home_url('/new-about-dr-ravi-rao/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/WhatsApp-Image-2025-05-14-at-2.06.43-PM-1.jpeg')); ?>" alt="About Vaastu" loading="lazy">
        <span class="about-card-title">About Vaastu</span>
        <span class="about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
      <a class="about-card" href="<?php echo esc_url(home_url('/new-about-dr-ravi-rao/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/55-scaled-e1751979726799.jpg')); ?>" alt="About Dr. Ravi Rao" loading="lazy">
        <span class="about-card-title">About Dr. Ravi Rao</span>
        <span class="about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
      <a class="about-card" href="<?php echo esc_url(home_url('/new-page-publications/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/Untitled-design-45.png')); ?>" alt="Publications" loading="lazy">
        <span class="about-card-title">Publications</span>
        <span class="about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
      <a class="about-card" href="<?php echo esc_url(home_url('/new-academic-contribution/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/Untitled-design-4.jpg')); ?>" alt="Academic Contributions" loading="lazy">
        <span class="about-card-title">Academic Contributions</span>
        <span class="about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
      <a class="about-card" href="<?php echo esc_url(home_url('/new-workshops-seminars/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/WhatsApp-Image-2025-07-09-at-9.46.13-PM.jpeg')); ?>" alt="Workshops and seminars" loading="lazy">
        <span class="about-card-title">Workshops &amp; Seminars</span>
        <span class="about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
    </div>
  </section>

  <section class="about-calendar" aria-labelledby="about-calendar-title">
    <div class="about-calendar-inner">
      <div class="about-section-heading">
        <p class="about-eyebrow">On the move</p>
        <h2 id="about-calendar-title">Travel Calendar</h2>
        <p>Upcoming travel dates and locations.</p>
      </div>
      <div class="about-calendar-widget">
        <?php echo do_shortcode('[my_calendar category="3,1,2" above="nav" below="key" time="month" weekends="false"]'); ?>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>