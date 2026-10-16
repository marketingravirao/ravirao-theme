<?php
/*
Template Name: Full Width
*/
get_header();
?>
<div class="full-width-page">
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php the_content(); wp_link_pages(); ?>
  </article>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>
