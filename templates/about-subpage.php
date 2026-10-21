<?php
/*
Template Name: About Subpage (Shared)
Template Post Type: page
*/
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main class="ravirao-about-page rr-about-shell rr-about-subpage">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('rr-about-article'); ?> id="post-<?php the_ID(); ?>">
      <section class="about-hero rr-about-hero" aria-labelledby="about-subpage-title">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('full', [
              'class' => 'about-hero-image rr-about-hero-image',
              'alt' => '',
              'fetchpriority' => 'high',
          ]); ?>
        <?php endif; ?>
        <div class="about-hero-content rr-about-hero-content rr-reveal rr-reveal-up">
          <p class="about-eyebrow rr-about-eyebrow">About Dr. Ravi Rao</p>
          <h1 id="about-subpage-title" class="rr-hero-title rr-hero-worded"><?php the_title(); ?></h1>
          <?php if (has_excerpt()) : ?>
            <div class="about-hero-subtitle rr-about-hero-subtitle"><?php the_excerpt(); ?></div>
          <?php endif; ?>
        </div>
      </section>

      <section class="rr-about-content-section" aria-label="<?php echo esc_attr(get_the_title()); ?>">
        <div class="rr-about-content rr-reveal rr-reveal-up">
          <?php the_content(); ?>
          <?php wp_link_pages(); ?>
        </div>
      </section>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
