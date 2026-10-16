<?php get_header(); ?>
<div class="container content-wrap">
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('entry'); ?> id="post-<?php the_ID(); ?>">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php the_content(); wp_link_pages(); ?>
  </article>
  <?php if (comments_open() || get_comments_number()) { comments_template(); } ?>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>
