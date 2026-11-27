<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once get_theme_file_path('/template-parts/journal/helpers.php');

get_header();
?>
<main class="rr-journal rrj-single">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('rrj-single__article'); ?>>
      <div class="rr-container">
        <nav class="rrj-breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'ravirao-theme'); ?>">
          <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ravirao-theme'); ?></a><span aria-hidden="true">/</span>
          <a href="<?php echo esc_url(get_post_type_archive_link('journal')); ?>"><?php esc_html_e('Journal', 'ravirao-theme'); ?></a>
        </nav>
        <header class="rrj-single__header">
          <p class="rrj-meta"><span class="rrj-tag"><?php echo esc_html(ravirao_journal_type_label(get_the_ID())); ?></span><span><?php echo esc_html(ravirao_journal_topics(get_the_ID())); ?></span><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></p>
          <h1><?php the_title(); ?></h1>
          <?php if (has_excerpt()) : ?><div class="rrj-single__excerpt"><?php the_excerpt(); ?></div><?php endif; ?>
          <p class="rrj-single__byline"><?php echo esc_html(sprintf(__('By %s', 'ravirao-theme'), get_the_author())); ?></p>
        </header>
        <?php if (has_post_thumbnail()) : ?>
          <figure class="rrj-single__featured-image"><?php the_post_thumbnail('full', ['loading' => 'eager', 'fetchpriority' => 'high']); ?></figure>
        <?php endif; ?>
        <div class="rrj-single__content"><?php the_content(); ?></div>
        <p class="rrj-single__back"><a class="rrj-button" href="<?php echo esc_url(get_post_type_archive_link('journal')); ?>"><?php esc_html_e('Back to the Journal', 'ravirao-theme'); ?></a></p>
      </div>
    </article>
  <?php endwhile; ?>
</main>
<?php
get_footer();
