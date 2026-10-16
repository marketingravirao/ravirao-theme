<?php
/*
Template Name: Landing Page
*/
get_header();
?>
<div class="landing-page">
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <?php the_content(); wp_link_pages(); ?>
  </article>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>
