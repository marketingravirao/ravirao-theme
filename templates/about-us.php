<?php
/*
Template Name: About Us
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
      'eyebrow' => 'About Ravi Rao',
      'description' => 'Explore the people, principles and experience behind Ravi Rao’s work.',
      'hero_image' => '/assets/images/about-dr-ravi-rao/hero-city-balcony.jpg',
      'section_eyebrow' => 'A closer look',
      'section_title' => 'Explore the work and ideas',
      'section_description' => 'Discover more about Dr. Ravi Rao, Vaastu Shastra, publications and contributions.',
  ]);
endwhile;
get_footer();
