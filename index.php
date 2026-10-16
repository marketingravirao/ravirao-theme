<?php get_header(); ?>
<div class="container content-wrap">
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('entry'); ?> id="post-<?php the_ID(); ?>">
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <?php if (is_singular()) { the_content(); wp_link_pages(); } else { the_excerpt(); } ?>
    </article>
  <?php endwhile; ?>
  <?php the_posts_pagination(); ?>
<?php else : ?>
  <h1><?php esc_html_e('Nothing found', 'ravirao-theme'); ?></h1>
  <?php get_search_form(); ?>
<?php endif; ?>
</div>
<?php get_footer(); ?>
