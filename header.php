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
<div class="top-header-branded">
  <div class="header-left">
    <div class="header-contact">
      <span class="header-icon">
        <img src="https://staging.ravirao.com/wp-content/uploads/2025/07/Untitled-design-36.png" alt="" width="25" height="25">
      </span>
      <a href="mailto:office@staging.ravirao.com">office@staging.ravirao.com</a>
    </div>
    <div class="header-contact">
      <span class="header-icon">
        <img src="https://staging.ravirao.com/wp-content/uploads/2025/07/Untitled-design-37.png" alt="" width="25" height="25">
      </span>
      <a href="tel:+919099608886">+91-9099608886</a>
    </div>
  </div>
  <div class="header-right">
    <a href="https://www.facebook.com/DrRaviRaoOfficial/" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="header-social">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
    </a>
    <a href="https://x.com/DrRaviRao" target="_blank" rel="noopener noreferrer" aria-label="X" class="header-social">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 4L20 20" />
        <path d="M20 4L4 20" />
      </svg>
    </a>
    <a href="https://www.instagram.com/drravirao/" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="header-social">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/></svg>
    </a>
    <a href="https://www.youtube.com/@DrRaoOfficialVaastuInsights" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="header-social">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="5" ry="5"/><polygon points="10 9 15 12 10 15 10 9" fill="#fff"/></svg>
    </a>
    <a href="https://www.linkedin.com/in/dr-ravi-rao-a883021a8/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="header-social">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="2" y="2" width="20" height="20" rx="5"/>
        <path d="M7 10v7"/>
        <circle cx="7" cy="7" r="1.3"/>
        <path d="M10.7 10v7m0-7h3.2c2 0 3.1 1.2 3.1 3.3v3.7"/>
      </svg>
    </a>
  </div>
</div>
<header class="site-header">
  <div class="container header-inner">
    <div class="site-brand">
      <?php if (has_custom_logo()) { the_custom_logo(); } else { ?>
        <a class="site-title" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(get_bloginfo('name')); ?></a>
      <?php } ?>
    </div>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
      <span class="menu-toggle-label"><?php esc_html_e('Menu', 'ravirao-theme'); ?></span>
      <span class="menu-toggle-icon" aria-hidden="true"><span></span><span></span><span></span></span>
    </button>
    <nav id="primary-navigation" class="primary-navigation" aria-label="<?php esc_attr_e('Main navigation', 'ravirao-theme'); ?>">
      <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'fallback_cb' => false]); ?>
    </nav>
  </div>
</header>
<main id="main-content" class="site-main">
