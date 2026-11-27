<?php
if (!defined('ABSPATH')) { exit; }
$rr_is_temple_vaastu_page = is_page_template('templates/temple-vaastu.php');
?>
<section class="business-enquiry-section" id="business-enquiry" aria-labelledby="business-enquiry-heading">
    <?php if ($rr_is_temple_vaastu_page) : ?>
      <div class="business-enquiry-section__heading rr-container">
        <p class="business-enquiry-section__eyebrow">11 / Start a conversation</p>
        <h2 class="rr-section-title" id="business-enquiry-heading">Let’s Discuss Your Temple Project</h2>
        <div class="business-enquiry-section__ornament" aria-hidden="true">
          <svg viewBox="0 0 260 30" role="presentation">
            <g fill="none" stroke="#ffd479" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
              <path d="M0 15H96M164 15H260" stroke-opacity=".75"/>
              <path d="M130 3C139 9 141 19 130 27C119 19 121 9 130 3Z"/>
              <path d="M130 27C122 26 113 21 109 11C118 11 126 17 130 27Z"/>
              <path d="M130 27C138 26 147 21 151 11C142 11 134 17 130 27Z"/>
              <path d="M130 27C119 28 107 25 100 18C111 15 123 19 130 27Z"/>
              <path d="M130 27C141 28 153 25 160 18C149 15 137 19 130 27Z"/>
            </g>
            <circle cx="90" cy="15" r="2.4" fill="#fff1c9"/>
            <circle cx="170" cy="15" r="2.4" fill="#fff1c9"/>
            <circle cx="130" cy="15" r="2.6" fill="#fff1c9"/>
          </svg>
        </div>
      </div>
    <?php endif; ?>
    <div class="business-enquiry-layout rr-container<?php echo $rr_is_temple_vaastu_page ? ' business-enquiry-layout--temple' : ''; ?>">
      <div class="business-enquiry-copy rr-reveal rr-reveal-left">
        <?php if ($rr_is_temple_vaastu_page) : ?>
          <p class="business-enquiry-section__consultation-label">Request a consultation</p>
          <h3 class="business-enquiry-section__temple-title">Thoughtful guidance begins with understanding your sacred space</h3>
          <p class="business-enquiry-section__description">Whether you are planning a new temple, restoring an existing sacred structure or preparing for consecration, Dr. Ravi Rao provides personalized Astro-Vaastu guidance and sacred ritual expertise tailored to the requirements of your temple project.</p>
          <p class="business-enquiry-section__services">Temple Vaastu &middot; Sacred Muhurta &middot; Consecration &amp; Rituals</p>
        <?php else : ?>
          <h2 class="rr-section-title" id="business-enquiry-heading">Let’s discuss your next project</h2>
          <p class="business-enquiry-section__description">Whether you are planning a new development, reviewing an existing facility or seeking personal Vaastu guidance, begin with a conversation about your requirements.</p>
          <p class="business-enquiry-section__services">Corporate &middot; Industrial &middot; Commercial &middot; Residential &middot; Institutional</p>
        <?php endif; ?>
        <ul class="business-enquiry-section__channels">
          <li>
            <a href="tel:+919099608886">
              <span class="business-enquiry-section__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></svg>
              </span>
              <span class="business-enquiry-section__contact">+91 90996 08886<small>Call the office</small></span>
            </a>
          </li>
          <li>
            <a href="https://wa.me/919099608886?text=Hello%20Dr.%20Ravi%20Rao%2C%20I%20would%20like%20to%20request%20a%20consultation."
              target="_blank" rel="noopener noreferrer">
              <span class="business-enquiry-section__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M4 20l1.3-4.2A8 8 0 1 1 8.4 19z"/><path d="M9 9.5c.3 2.2 2.3 4.2 4.5 4.5l1.3-1.3-2-1-.8.7a3 3 0 0 1-1.6-1.6l.7-.8-1-2z"/></svg>
              </span>
              <span class="business-enquiry-section__contact">Message on WhatsApp<small><?php echo $rr_is_temple_vaastu_page ? 'Share your project details or architectural plans' : 'Share a plan or a few details'; ?></small></span>
            </a>
          </li>
          <li>
            <a href="mailto:office@ravirao.com">
              <span class="business-enquiry-section__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
              </span>
              <span class="business-enquiry-section__contact">office@ravirao.com<small>Write to the team</small></span>
            </a>
          </li>
        </ul>
        <?php if ($rr_is_temple_vaastu_page) : ?>
          <p class="business-enquiry-section__appointment">Consultations are held by appointment.</p>
          <div class="business-enquiry-section__emblem" aria-hidden="true">
            <span class="business-enquiry-section__emblem-halo"></span>
            <img class="business-enquiry-section__emblem-icon" src="<?php echo esc_url(get_theme_file_uri('/assets/images/temple-vaastu/contact-emblem.webp')); ?>" alt="" width="640" height="640">
            <span class="business-enquiry-section__emblem-ring"><i></i></span>
            <span class="business-enquiry-section__emblem-trishula"><i></i></span>
            <span class="business-enquiry-section__emblem-flare"></span>
          </div>
        <?php else : ?>
          <p class="business-enquiry-section__appointment">Consultations are held by appointment. Share a few details and the team will get back to you.</p>
        <?php endif; ?>
      </div>
      <div class="business-enquiry-form rr-reveal rr-reveal-right">
        <?php if (!$rr_is_temple_vaastu_page) : ?>
          <h3 class="business-enquiry-section__form-title">Request a consultation</h3>
        <?php endif; ?>
        <?php get_template_part('template-parts/sections/consultation-form-embed'); ?>
      </div>
    </div>
  </section>
<footer class="main-footer-branded-v2">
  <div class="footer-content-v2 rr-container">
    <div class="footer-col-v2 about">
      <div class="footer-heading-v2"><span class="footer-bar-v2"></span> <span>About</span></div>
      <p>Dr. Ravi Rao is an established astrologer and Vaastu consultant with over 30 years of experience. He specializes in corporate Astro-Vaastu analysis, Vaastu for industries, and holistic guidance for organizations and individuals.</p>
    </div>
    <div class="footer-col-v2 links">
      <div class="footer-heading-v2"><span class="footer-bar-v2"></span> <span>Links</span></div>
      <ul>
        <li><a href="<?php echo esc_url(home_url('/homepage-ms/')); ?>"><span class="footer-link-arrow">&#8250;</span> <span class="footer-link-label">Home</span></a></li>
        <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>"><span class="footer-link-arrow">&#8250;</span> <span class="footer-link-label">About</span></a></li>
        <li><a href="<?php echo esc_url(home_url('/clients-sectors/')); ?>"><span class="footer-link-arrow">&#8250;</span> <span class="footer-link-label">Clients</span></a></li>
        <li><a href="<?php echo esc_url(home_url('/blogs/')); ?>"><span class="footer-link-arrow">&#8250;</span> <span class="footer-link-label">Blogs</span></a></li>
        <li><a href="<?php echo esc_url(home_url('/services/')); ?>"><span class="footer-link-arrow">&#8250;</span> <span class="footer-link-label">Services</span></a></li>
        <li><a href="<?php echo esc_url(home_url('/#business-enquiry')); ?>"><span class="footer-link-arrow">&#8250;</span> <span class="footer-link-label">Contact</span></a></li>
      </ul>
    </div>
    <div class="footer-col-v2 contact">
      <div class="footer-heading-v2"><span class="footer-bar-v2"></span> <span>Get in Touch With Us</span></div>
      <div class="footer-contact-block">
        <address>
          B-302, Balleshwar Square, Opp. ISKCON Temple,<br>
          S. G. Highway, Ahmedabad – 380015,<br>
          Gujarat (India)<br>
          <a href="tel:+919099608886">+91-9099608886</a><br>
          <a href="mailto:<?php echo esc_attr(antispambot(RAVIRAO_THEME_CONTACT_EMAIL)); ?>"><?php echo esc_html(antispambot(RAVIRAO_THEME_CONTACT_EMAIL)); ?></a>
        </address>
        <ul class="footer-social-links-v2">
          <li><a href="https://www.facebook.com/DrRaviRaoOfficial/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
            <span class="footer-social-icons dashicons dashicons-facebook-alt" aria-hidden="true"></span> <span class="footer-link-label">Facebook</span></a>
          </li>
          <li><a href="https://x.com/DrRaviRao" target="_blank" rel="noopener noreferrer" aria-label="X">
            <svg class="footer-social-icons footer-x-icon" viewBox="0 0 24 24" aria-hidden="true">
              <path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg> <span class="footer-link-label">X (Twitter)</span></a>
          </li>
          <li><a href="https://www.instagram.com/drravirao/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
            <span class="footer-social-icons dashicons dashicons-instagram" aria-hidden="true"></span> <span class="footer-link-label">Instagram</span></a>
          </li>
          <li><a href="https://www.youtube.com/@DrRaoOfficialVaastuInsights" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
            <span class="footer-social-icons dashicons dashicons-youtube" aria-hidden="true"></span> <span class="footer-link-label">YouTube</span></a>
          </li>
          <li><a href="https://www.linkedin.com/in/dr-ravi-rao-a883021a8/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <span class="footer-social-icons dashicons dashicons-linkedin" aria-hidden="true"></span> <span class="footer-link-label">LinkedIn</span></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-bottom-v2 rr-container">
    <span>&copy; 2026 Dr. Ravi Rao. All Rights Reserved.</span>
  </div>
</footer>
