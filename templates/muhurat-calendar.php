<?php
/*
Template Name: Muhurat
Template Post Type: page
*/
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main class="rr-muhurat" id="main-content">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('rr-muhurat__page'); ?>>
      <section class="rr-muhurat__hero" aria-labelledby="rr-muhurat-title">
        <div class="rr-container rr-muhurat__hero-inner">
          <nav class="rr-muhurat__breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'ravirao-theme'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ravirao-theme'); ?></a>
            <span aria-hidden="true">/</span>
            <span aria-current="page"><?php the_title(); ?></span>
          </nav>
          <div class="rr-muhurat__hero-copy">
            <p class="rr-muhurat__eyebrow"><?php esc_html_e('Auspicious dates and timings', 'ravirao-theme'); ?></p>
            <h1 id="rr-muhurat-title"><?php the_title(); ?></h1>
            <p><?php esc_html_e('Explore auspicious dates for your important beginnings and ceremonies.', 'ravirao-theme'); ?></p>
          </div>
          <div class="rr-muhurat__ornament" aria-hidden="true"><span>ॐ</span></div>
        </div>
      </section>

      <section class="rr-muhurat__calendar-section" aria-labelledby="rr-muhurat-calendar-title">
        <div class="rr-container">
          <header class="rr-muhurat__section-heading">
            <p class="rr-muhurat__eyebrow"><?php esc_html_e('Plan with confidence', 'ravirao-theme'); ?></p>
            <h2 id="rr-muhurat-calendar-title"><?php esc_html_e('Find an auspicious date', 'ravirao-theme'); ?></h2>
            <p><?php esc_html_e('Choose a month to explore available dates and their details.', 'ravirao-theme'); ?></p>
          </header>
          <div class="rr-muhurat__calendar-card">
            <?php if (shortcode_exists('my_calendar')) : ?>
              <div class="rr-muhurat__calendar-content"><?php echo do_shortcode('[my_calendar category="4" weekends="true"]'); ?></div>
            <?php else : ?>
              <p class="rr-muhurat__unavailable"><?php esc_html_e('The Muhurat calendar is currently unavailable. Please try again later.', 'ravirao-theme'); ?></p>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </article>
  <?php endwhile; ?>
</main>
<?php
get_footer();
