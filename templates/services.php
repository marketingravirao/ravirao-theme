<?php
/*
Template Name: Services
Template Post Type: page
*/
if (!defined('ABSPATH')) {
  exit;
}

get_header();
while (have_posts()) :
  the_post();
  get_template_part('template-parts/sections/page-directory', null, [
      'page_id' => get_the_ID(),
      'eyebrow' => 'Vaastu consultations',
      'description' => 'Thoughtful Vaastu guidance for the places where people live, work and gather.',
      'hero_image' => '/assets/images/homepage-design/hero-architecture.jpg',
      'section_eyebrow' => 'Our areas of expertise',
      'section_title' => 'Guidance for every kind of place',
      'section_description' => 'Explore consultation services tailored to your property, project and plans.',
  ]);
endwhile;
get_footer();
