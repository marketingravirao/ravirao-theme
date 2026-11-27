<?php
if (!defined('ABSPATH')) { exit; }

$is_archive = is_archive();
$posts_page_id = (int) get_option('page_for_posts');

if ($is_archive) {
    $archive_title = get_the_archive_title();
    $archive_description = get_the_archive_description();
} else {
    $archive_title = $posts_page_id ? get_the_title($posts_page_id) : __('Journal', 'ravirao-theme');
    $archive_description = $posts_page_id ? get_post_field('post_excerpt', $posts_page_id) : '';

    if (!$archive_description) {
        $archive_description = __('Ideas, perspectives and articles on Vaastu, astrology and traditional knowledge.', 'ravirao-theme');
    }
}
?>
<div class="rr-blog-page rr-blog-archive">
  <header class="rr-blog-archive-hero">
    <div class="rr-blog-container">
      <p class="rr-blog-eyebrow"><?php esc_html_e('Ravi Rao Journal', 'ravirao-theme'); ?></p>
      <h1><?php echo $is_archive ? wp_kses_post($archive_title) : esc_html($archive_title); ?></h1>
      <?php if ($archive_description) : ?>
        <div class="rr-blog-archive-description">
          <?php echo $is_archive ? wp_kses_post($archive_description) : wp_kses_post(wpautop($archive_description)); ?>
        </div>
      <?php endif; ?>
    </div>
  </header>

  <div class="rr-blog-container rr-blog-archive-content">
    <?php if (have_posts()) : ?>
      <div class="rr-blog-grid">
        <?php while (have_posts()) : the_post(); ?>
          <article <?php post_class('rr-blog-card'); ?> id="post-<?php the_ID(); ?>">
            <?php if (has_post_thumbnail()) : ?>
              <a class="rr-blog-card-image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(sprintf(__('Read article: %s', 'ravirao-theme'), get_the_title())); ?>">
                <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
              </a>
            <?php else : ?>
              <div class="rr-blog-card-image rr-blog-card-image-placeholder" aria-hidden="true">
                <span><?php esc_html_e('Ravi Rao', 'ravirao-theme'); ?></span>
              </div>
            <?php endif; ?>

            <div class="rr-blog-card-content">
              <?php $categories = get_the_category_list(' · '); ?>
              <?php if ($categories) : ?>
                <div class="rr-blog-categories"><?php echo wp_kses_post($categories); ?></div>
              <?php endif; ?>

              <p class="rr-blog-card-date">
                <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time>
              </p>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="rr-blog-card-excerpt"><?php the_excerpt(); ?></div>
              <a class="rr-blog-read-more" href="<?php the_permalink(); ?>">
                <?php esc_html_e('Read article', 'ravirao-theme'); ?>
                <span aria-hidden="true">&rarr;</span>
              </a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <div class="rr-blog-pagination">
        <?php
        the_posts_pagination([
            'mid_size' => 1,
            'prev_text' => esc_html__('Previous', 'ravirao-theme'),
            'next_text' => esc_html__('Next', 'ravirao-theme'),
        ]);
        ?>
      </div>
    <?php else : ?>
      <div class="rr-blog-empty">
        <h2><?php esc_html_e('No articles found', 'ravirao-theme'); ?></h2>
        <p><?php esc_html_e('There are no posts to display here yet. Please check back soon.', 'ravirao-theme'); ?></p>
        <?php get_search_form(); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
