<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<div class="rr-blog-page rr-blog-single">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $posts_page_id = (int) get_option('page_for_posts');
    $journal_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
    $journal_title = $posts_page_id ? get_the_title($posts_page_id) : __('Journal', 'ravirao-theme');
    $author_id = (int) get_the_author_meta('ID');
    $author_bio = get_the_author_meta('description', $author_id);
    ?>
    <article <?php post_class('rr-blog-article'); ?> id="post-<?php the_ID(); ?>">
      <div class="rr-blog-container">
        <header class="rr-blog-article-header">
          <nav class="rr-blog-breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'ravirao-theme'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ravirao-theme'); ?></a>
            <span aria-hidden="true">/</span>
            <a href="<?php echo esc_url($journal_url); ?>"><?php echo esc_html($journal_title); ?></a>
          </nav>

          <?php $categories = get_the_category_list(' · '); ?>
          <?php if ($categories) : ?>
            <div class="rr-blog-categories"><?php echo wp_kses_post($categories); ?></div>
          <?php endif; ?>

          <h1><?php the_title(); ?></h1>
          <div class="rr-blog-post-meta">
            <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time>
            <span class="rr-blog-meta-divider" aria-hidden="true"></span>
            <span>
              <?php esc_html_e('By', 'ravirao-theme'); ?>
              <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php echo esc_html(get_the_author()); ?></a>
            </span>
          </div>
          <?php if (has_excerpt()) : ?>
            <div class="rr-blog-article-intro"><?php the_excerpt(); ?></div>
          <?php endif; ?>
        </header>

        <?php if (has_post_thumbnail()) : ?>
          <figure class="rr-blog-featured-image">
            <?php the_post_thumbnail('full', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
          </figure>
        <?php endif; ?>

        <div class="rr-blog-article-layout">
          <div class="rr-blog-article-content">
            <?php the_content(); ?>
            <?php
            wp_link_pages([
                'before' => '<nav class="rr-blog-page-links" aria-label="' . esc_attr__('Article pages', 'ravirao-theme') . '">',
                'after' => '</nav>',
            ]);
            ?>

            <?php $tags = get_the_tag_list('', ' '); ?>
            <?php if ($tags) : ?>
              <div class="rr-blog-tags">
                <span><?php esc_html_e('Filed under', 'ravirao-theme'); ?></span>
                <?php echo wp_kses_post($tags); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <aside class="rr-blog-author">
          <?php echo get_avatar($author_id, 72, '', get_the_author(), ['class' => 'rr-blog-author-avatar']); ?>
          <div>
            <p class="rr-blog-author-label"><?php esc_html_e('About the author', 'ravirao-theme'); ?></p>
            <h2><a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php echo esc_html(get_the_author()); ?></a></h2>
            <?php if ($author_bio) : ?>
              <div><?php echo wp_kses_post(wpautop($author_bio)); ?></div>
            <?php endif; ?>
          </div>
        </aside>
      </div>
    </article>

    <div class="rr-blog-container rr-blog-post-navigation">
      <?php
      the_post_navigation([
          'prev_text' => '<span class="rr-blog-navigation-label">' . esc_html__('Previous article', 'ravirao-theme') . '</span><span class="rr-blog-navigation-title">%title</span>',
          'next_text' => '<span class="rr-blog-navigation-label">' . esc_html__('Next article', 'ravirao-theme') . '</span><span class="rr-blog-navigation-title">%title</span>',
      ]);
      ?>
    </div>

    <?php if (comments_open() || get_comments_number()) : ?>
      <div class="rr-blog-container rr-blog-comments">
        <?php comments_template(); ?>
      </div>
    <?php endif; ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
