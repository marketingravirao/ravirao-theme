<?php
/*
Template Name: About Page (Branded)
Template Post Type: page
*/
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<div class="ravirao-about-page rr-about-shell">
  <section class="about-hero rr-about-hero" aria-labelledby="about-hero-title">
    <img
      class="about-hero-image rr-about-hero-image"
      src="<?php echo esc_url(content_url('/uploads/2025/07/2B2A4121-scaled.jpg')); ?>"
      alt=""
      fetchpriority="high">
    <div class="about-hero-content rr-about-hero-content rr-reveal rr-reveal-up">
      <p class="about-eyebrow rr-about-eyebrow">About Dr. Ravi Rao</p>
      <h1 id="about-hero-title" class="rr-hero-title rr-hero-worded">Discover Dr. Ravi Rao’s World</h1>
      <p class="about-hero-subtitle rr-about-hero-subtitle rr-reveal rr-reveal-up">Legacy, Learning &amp; Leadership</p>
    </div>
  </section>

  <section class="about-destinations rr-about-section" aria-labelledby="about-destinations-title">
    <div class="about-section-heading rr-about-heading rr-reveal rr-reveal-up">
      <p class="about-eyebrow rr-about-eyebrow">A closer look</p>
      <h2 id="about-destinations-title">Explore the work and ideas</h2>
    </div>
    <div class="about-card-grid rr-about-card-grid rr-reveal-group">
      <a class="about-card rr-about-card rr-reveal rr-reveal-up" href="<?php echo esc_url(home_url('/new-vaastu-about-page/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/WhatsApp-Image-2025-05-14-at-2.06.43-PM-1.jpeg')); ?>" alt="About Vaastu" loading="lazy">
        <span class="about-card-title rr-about-card-title">About Vaastu</span>
        <span class="about-card-arrow rr-about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
      <a class="about-card rr-about-card rr-reveal rr-reveal-up" href="<?php echo esc_url(home_url('/new-about-dr-ravi-rao/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/55-scaled-e1751979726799.jpg')); ?>" alt="About Dr. Ravi Rao" loading="lazy">
        <span class="about-card-title rr-about-card-title">About Dr. Ravi Rao</span>
        <span class="about-card-arrow rr-about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
      <a class="about-card rr-about-card rr-reveal rr-reveal-up" href="<?php echo esc_url(home_url('/new-page-publications/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/Untitled-design-45.png')); ?>" alt="Publications" loading="lazy">
        <span class="about-card-title rr-about-card-title">Publications</span>
        <span class="about-card-arrow rr-about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
      <a class="about-card rr-about-card rr-reveal rr-reveal-up" href="<?php echo esc_url(home_url('/new-academic-contribution/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/Untitled-design-4.jpg')); ?>" alt="Academic Contributions" loading="lazy">
        <span class="about-card-title rr-about-card-title">Academic Contributions</span>
        <span class="about-card-arrow rr-about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
      <a class="about-card rr-about-card rr-reveal rr-reveal-up" href="<?php echo esc_url(home_url('/new-workshops-seminars/')); ?>">
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/WhatsApp-Image-2025-07-09-at-9.46.13-PM.jpeg')); ?>" alt="Workshops and seminars" loading="lazy">
        <span class="about-card-title rr-about-card-title">Workshops &amp; Seminars</span>
        <span class="about-card-arrow rr-about-card-arrow" aria-hidden="true">&#8599;</span>
      </a>
    </div>
  </section>

  <section class="about-calendar rr-about-calendar" aria-labelledby="about-calendar-title">
    <div class="about-calendar-inner rr-about-inner">
      <div class="about-section-heading rr-about-heading rr-reveal rr-reveal-up">
        <p class="about-eyebrow rr-about-eyebrow">On the move</p>
        <h2 id="about-calendar-title">Travel Calendar Of Dr. Ravi Rao</h2>
        <p>Upcoming travel dates and locations.</p>
      </div>
      <div class="about-calendar-widget rr-about-widget rr-reveal rr-reveal-up">
        <?php echo do_shortcode('[my_calendar category="3,1,2" above="nav" below="key" time="month" weekends="false"]'); ?>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>