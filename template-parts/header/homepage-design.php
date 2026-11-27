<?php
if (!defined('ABSPATH')) { exit; }

$contact_email = RAVIRAO_THEME_CONTACT_EMAIL;
?>
<div class="topbar">
  <span class="tb-l">
    <a href="mailto:<?php echo esc_attr($contact_email); ?>" data-cta="topbar_email">✉ <?php echo esc_html($contact_email); ?></a>
    <a href="tel:+919099608886" data-cta="topbar_phone">☎ +91 90996 08886</a>
    <span>Consultation by appointment</span>
  </span>
  <span class="tb-r">
    <a href="#muhurat" data-cta="topbar_muhurat">Muhurat Calendar</a>
    <a href="#travel" data-cta="topbar_travel">Travel Calendar</a>
  </span>
</div>
<nav class="nav" aria-label="Main">
  <a class="logo" href="<?php echo esc_url(home_url('/')); ?>"><span>✦</span> RAVIRAO</a>
  <div class="links" id="site-menu">
    <a href="<?php echo esc_url(home_url('/about-dr-ravi-rao/')); ?>">About</a>
    <a href="#services">Services</a>
    <a href="#trust">Clients</a>
    <a href="#sectors">Sectors</a>
    <a href="#books">Books</a>
    <a href="#journal">Blog</a>
  </div>
  <div class="nav-actions">
    <a class="btn" href="#contact" data-cta="nav_primary">
      <span class="lg">Request a Consultation</span>
      <span class="sh">Consultation</span>
    </a>
    <button class="menu-btn" type="button" aria-expanded="false" aria-controls="site-menu">Menu</button>
  </div>
</nav>
