<?php
/*
Template Name: Blank Page (No Header/Footer)
*/
if (!defined('ABSPATH')) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main id="main-content">
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <?php the_content(); wp_link_pages(); ?>
  </article>
<?php endwhile; ?>
</main>
<?php wp_footer(); ?>
</body>
</html>
