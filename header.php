<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e('Skip to content', 'ravirao-theme'); ?></a>
<header class="site-header">
  <div class="container header-inner">
    <div class="site-brand">
      <?php if (has_custom_logo()) { the_custom_logo(); } else { ?>
        <a class="site-title" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(get_bloginfo('name')); ?></a>
      <?php } ?>
    </div>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation"><?php esc_html_e('Menu', 'ravirao-theme'); ?></button>
    <nav id="primary-navigation" class="primary-navigation" aria-label="<?php esc_attr_e('Primary navigation', 'ravirao-theme'); ?>">
      <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'fallback_cb' => false]); ?>
    </nav>
  </div>
</header>
<main id="main-content" class="site-main">
