<?php
/*
Template Name: Residential Vaastu
Template Post Type: page
*/
if (!defined('ABSPATH')) {
  exit;
}

/*
 * Optional page custom fields:
 *   residential_vaastu_video             YouTube URL or direct .mp4/.webm URL
 *   residential_vaastu_video_title       Video title shown below the player
 *   residential_vaastu_video_description Short description beside the video heading
 */
$rr_rv_page_id = get_queried_object_id();
$rr_rv_video_url = trim((string) get_post_meta($rr_rv_page_id, 'residential_vaastu_video', true));
$rr_rv_video_title = trim((string) get_post_meta($rr_rv_page_id, 'residential_vaastu_video_title', true));
$rr_rv_video_description = trim((string) get_post_meta($rr_rv_page_id, 'residential_vaastu_video_description', true));
if ($rr_rv_video_url === '') {
  $rr_rv_video_url = 'https://youtu.be/KdKxlitTMsU';
}
if ($rr_rv_video_title === '') {
  $rr_rv_video_title = 'Dr. Ravi Rao on Vaastu';
}
$rr_rv_youtube_id = '';
if (preg_match('~(?:youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $rr_rv_video_url, $rr_rv_match)) {
  $rr_rv_youtube_id = $rr_rv_match[1];
}
$rr_rv_is_video_file = (bool) preg_match('~\.(mp4|webm)(\?.*)?$~i', $rr_rv_video_url);
$rr_rv_image = static function ($file) {
  return get_theme_file_uri('/assets/images/residential-vaastu/' . $file);
};

get_header();
?>
<div class="residential-vaastu">
  <section class="residential-vaastu__hero" aria-labelledby="residential-vaastu-title">
    <div class="residential-vaastu__container residential-vaastu__hero-layout">
      <div class="residential-vaastu__hero-copy">
        <nav class="residential-vaastu__breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'ravirao-theme'); ?>">
          <a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a>
          <span aria-hidden="true">/</span>
          <span aria-current="page">Residential Vaastu</span>
        </nav>
        <p class="residential-vaastu__eyebrow residential-vaastu__eyebrow--light">Specialized Vaastu Consultation / Residential</p>
        <h1 class="residential-vaastu__hero-title" id="residential-vaastu-title">Residential Vaastu <em>Consultation</em></h1>
        <p class="residential-vaastu__lead">Traditional Vaastu wisdom for modern homes.</p>
        <p class="residential-vaastu__text residential-vaastu__text--hero">Specialized guidance for villas, bungalows, independent houses and apartments — from plot selection to existing-home assessment.</p>
        <a class="residential-vaastu__button residential-vaastu__button--large" href="#business-enquiry">Discuss Your Residential Project <span aria-hidden="true">→</span></a>
      </div>
      <div class="residential-vaastu__compass" role="img" aria-label="<?php esc_attr_e('Vaastu compass around a residence', 'ravirao-theme'); ?>">
        <div class="residential-vaastu__compass-disc"></div>
        <div class="residential-vaastu__compass-photo"></div>
        <svg class="residential-vaastu__compass-svg" viewBox="0 0 500 500" aria-hidden="true" focusable="false">
          <defs>
            <linearGradient id="residential-vaastu-compass-sweep" gradientUnits="userSpaceOnUse" x1="250" y1="0" x2="150" y2="0">
              <stop offset="0" stop-color="#e44535" stop-opacity=".55" />
              <stop offset="1" stop-color="#e44535" stop-opacity="0" />
            </linearGradient>
          </defs>
          <g fill="none" stroke="#fff">
            <circle cx="250" cy="250" r="244" stroke-opacity=".6" />
            <circle cx="250" cy="250" r="224" stroke-opacity=".3" />
            <circle cx="250" cy="250" r="180" stroke-width="1.6" stroke-opacity=".9" />
          </g>
          <g class="residential-vaastu__compass-ticks">
            <path d="M250 26V6M272.7 19.1L273.9 7.2M295.3 22.5L297.6 10.7M317.3 28L320.8 16.5M335.7 43.1L343.4 24.6M359.4 45.4L365 34.8M378.9 57.1L385.6 47.1M397.2 70.7L404.8 61.4M408.4 91.6L422.5 77.5M429.3 102.8L438.6 95.2M442.9 121.1L452.9 114.4M454.6 140.6L465.2 135M456.9 164.3L475.4 156.6M472 182.7L483.5 179.2M477.5 204.7L489.3 202.4M480.9 227.3L492.8 226.1M474 250H494M480.9 272.7L492.8 273.9M477.5 295.3L489.3 297.6M472 317.3L483.5 320.8M456.9 335.7L475.4 343.4M454.6 359.4L465.2 365M442.9 378.9L452.9 385.6M429.3 397.2L438.6 404.8M408.4 408.4L422.5 422.5M397.2 429.3L404.8 438.6M378.9 442.9L385.6 452.9M359.4 454.6L365 465.2M335.7 456.9L343.4 475.4M317.3 472L320.8 483.5M295.3 477.5L297.6 489.3M272.7 480.9L273.9 492.8M250 474V494M227.3 480.9L226.1 492.8M204.7 477.5L202.4 489.3M182.7 472L179.2 483.5M164.3 456.9L156.6 475.4M140.6 454.6L135 465.2M121.1 442.9L114.4 452.9M102.8 429.3L95.2 438.6M91.6 408.4L77.5 422.5M70.7 397.2L61.4 404.8M57.1 378.9L47.1 385.6M45.4 359.4L34.8 365M43.1 335.7L24.6 343.4M28 317.3L16.5 320.8M22.5 295.3L10.7 297.6M19.1 272.7L7.2 273.9M26 250H6M19.1 227.3L7.2 226.1M22.5 204.7L10.7 202.4M28 182.7L16.5 179.2M43.1 164.3L24.6 156.6M45.4 140.6L34.8 135M57.1 121.1L47.1 114.4M70.7 102.8L61.4 95.2M91.6 91.6L77.5 77.5M102.8 70.7L95.2 61.4M121.1 57.1L114.4 47.1M140.6 45.4L135 34.8M164.3 43.1L156.6 24.6M182.7 28L179.2 16.5M204.7 22.5L202.4 10.7M227.3 19.1L226.1 7.2" fill="none" stroke="#fff" stroke-opacity=".6" />
          </g>
          <circle class="residential-vaastu__compass-dots" cx="250" cy="250" r="212" fill="none" stroke="#fff" stroke-opacity=".5" stroke-dasharray="2 9" />
          <circle class="residential-vaastu__compass-pulse" cx="250" cy="250" r="180" fill="none" stroke="#fff" stroke-width="1.5" />
          <path d="M250 68V30M319.6 81.9L334.2 46.7M378.7 121.3L405.6 94.4M418.1 180.4L453.3 165.8M432 250H470M418.1 319.6L453.3 334.2M378.7 378.7L405.6 405.6M319.6 418.1L334.2 453.3M250 432V470M180.4 418.1L165.8 453.3M121.3 378.7L94.4 405.6M81.9 319.6L46.7 334.2M68 250H30M81.9 180.4L46.7 165.8M121.3 121.3L94.4 94.4M180.4 81.9L165.8 46.7" fill="none" stroke="#fff" stroke-opacity=".4" />
          <path d="M250 2L240 24H260Z" fill="#e44535" />
          <g font-size="15" font-weight="700" text-anchor="middle" dominant-baseline="middle">
            <text class="residential-vaastu__compass-label residential-vaastu__compass-label--north" x="250" y="47" fill="#ff8a78">N</text>
            <text class="residential-vaastu__compass-label" x="393.5" y="106.5" fill="#fff">NE</text>
            <text class="residential-vaastu__compass-label" x="453" y="250" fill="#fff">E</text>
            <text class="residential-vaastu__compass-label" x="393.5" y="393.5" fill="#fff">SE</text>
            <text class="residential-vaastu__compass-label" x="250" y="453" fill="#fff">S</text>
            <text class="residential-vaastu__compass-label" x="106.5" y="393.5" fill="#fff">SW</text>
            <text class="residential-vaastu__compass-label" x="47" y="250" fill="#fff">W</text>
            <text class="residential-vaastu__compass-label" x="106.5" y="106.5" fill="#fff">NW</text>
          </g>
          <g class="residential-vaastu__compass-needle">
            <path d="M250 250V100A150 150 0 0 0 153.6 135.1Z" fill="url(#residential-vaastu-compass-sweep)" />
            <path d="M250 100L258 250L250 262L242 250Z" fill="#e44535" />
            <path d="M250 400L258 250L250 238L242 250Z" fill="#fff" fill-opacity=".85" />
          </g>
          <g>
            <circle cx="250" cy="250" r="7" fill="#fff" />
            <circle cx="250" cy="250" r="3" fill="#e44535" />
          </g>
        </svg>
      </div>
    </div>
  </section>

  <section class="residential-vaastu__highlights" aria-label="<?php esc_attr_e('Residential consultation focus', 'ravirao-theme'); ?>">
    <div class="residential-vaastu__container residential-vaastu__highlight-grid">
      <div class="residential-vaastu__highlight">
        <svg class="residential-vaastu__icon residential-vaastu__icon--small" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.6"/></svg>
        <div><b>New Homes</b><span>Guidance from plot selection to layout planning</span></div>
      </div>
      <div class="residential-vaastu__highlight">
        <svg class="residential-vaastu__icon residential-vaastu__icon--small" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 4h18v16H3zM8 4v16M3 10h5m5-6v7m0 0 3-3m-3 3-3-3"/></svg>
        <div><b>Existing Homes</b><span>Assessment and feasible spatial adjustments</span></div>
      </div>
      <div class="residential-vaastu__highlight">
        <svg class="residential-vaastu__icon residential-vaastu__icon--small" viewBox="0 0 24 24" aria-hidden="true"><circle cx="8" cy="9" r="3"/><circle cx="17" cy="10" r="2.4"/><path d="M2 20c0-3.3 2.7-6 6-6s6 2.7 6 6m1 0c0-2.3 1.4-4 3.5-4.4"/></svg>
        <div><b>Design Team Coordination</b><span>Working alongside architects and interior designers</span></div>
      </div>
    </div>
  </section>

  <?php
  get_template_part('template-parts/sections/trusted-brands', null, [
      'id' => 'residential-vaastu-trusted-brands',
      'title' => 'Trusted by Leading Brands',
      'tagline' => 'Organizations across industries have placed their trust in Dr. Ravi Rao’s Vaastu expertise.',
      'soft' => true,
      'section_class' => 'residential-vaastu__trust',
      'heading_class' => 'residential-vaastu__trust-heading',
      'title_class' => 'residential-vaastu__trust-title',
      'tagline_class' => 'residential-vaastu__trust-tagline',
      'track_class' => 'residential-vaastu__trust-track',
  ]);
  ?>

  <section class="residential-vaastu__section residential-vaastu__perspective" aria-labelledby="residential-vaastu-perspective-title">
    <div class="residential-vaastu__container residential-vaastu__perspective-layout">
      <div class="residential-vaastu__perspective-copy">
        <p class="residential-vaastu__eyebrow">01 / The perspective</p>
        <h2 class="residential-vaastu__title" id="residential-vaastu-perspective-title">A home is more than a floor plan. <em>It shapes the rhythm of daily life.</em></h2>
        <p class="residential-vaastu__text">Every home brings together the plot, the entrance, living areas, kitchen, bedrooms and the people who live in them. In the Vaastu tradition, the orientation and arrangement of these elements are considered in relation to the purpose of each space.</p>
        <p class="residential-vaastu__text">Dr. Ravi Rao provides Residential Vaastu consultations tailored to the needs of each family and home, combining traditional spatial principles with the practical requirements of residential planning.</p>
      </div>
      <figure class="residential-vaastu__feature">
        <img src="<?php echo esc_url($rr_rv_image('house-construction.jpg')); ?>" alt="<?php esc_attr_e('A home under construction, illustrating the importance of early planning', 'ravirao-theme'); ?>" loading="lazy" width="1500" height="1000">
        <figcaption>PLOT <span aria-hidden="true">/</span> ENTRANCE <span aria-hidden="true">/</span> ROOMS</figcaption>
      </figure>
    </div>
  </section>

  <section class="residential-vaastu__section residential-vaastu__video-section" id="residential-video" aria-labelledby="residential-vaastu-video-title">
    <div class="residential-vaastu__container">
      <div class="residential-vaastu__section-heading residential-vaastu__section-heading--dark">
        <div>
          <p class="residential-vaastu__eyebrow residential-vaastu__eyebrow--light">02 / Video</p>
          <h2 class="residential-vaastu__title" id="residential-vaastu-video-title">Residential Vaastu on video</h2>
        </div>
        <p><?php echo esc_html($rr_rv_video_description ?: 'Dr. Ravi Rao on applying Vaastu principles to the planning and assessment of homes.'); ?></p>
      </div>
      <?php if ($rr_rv_youtube_id) : ?>
        <div class="residential-vaastu__video">
          <iframe src="<?php echo esc_url('https://www.youtube-nocookie.com/embed/' . $rr_rv_youtube_id); ?>" title="<?php echo esc_attr($rr_rv_video_title ?: 'Residential Vaastu consultation'); ?>" loading="lazy" allow="accelerometer; encrypted-media; picture-in-picture" allowfullscreen></iframe>
        </div>
      <?php elseif ($rr_rv_is_video_file) : ?>
        <div class="residential-vaastu__video">
          <video src="<?php echo esc_url($rr_rv_video_url); ?>" poster="<?php echo esc_url($rr_rv_image('house-yellow.jpg')); ?>" controls playsinline preload="metadata"></video>
        </div>
      <?php else : ?>
        <div class="residential-vaastu__video residential-vaastu__video--placeholder">
          <img src="<?php echo esc_url($rr_rv_image('house-yellow.jpg')); ?>" alt="" loading="lazy" width="1500" height="997">
          <p><?php esc_html_e('Video coming soon', 'ravirao-theme'); ?></p>
        </div>
      <?php endif; ?>
      <?php if ($rr_rv_video_title) : ?><p class="residential-vaastu__video-caption"><?php echo esc_html($rr_rv_video_title); ?></p><?php endif; ?>
    </div>
  </section>

  <section class="residential-vaastu__section residential-vaastu__section--cream" id="residential-services" aria-labelledby="residential-vaastu-scope-title">
    <div class="residential-vaastu__container">
      <div class="residential-vaastu__section-heading">
        <div>
          <p class="residential-vaastu__eyebrow">03 / Scope of consultation</p>
          <h2 class="residential-vaastu__title" id="residential-vaastu-scope-title">Every part of the home has its place.</h2>
        </div>
        <p>The consultation considers the home as a whole, while addressing the functional requirements of each room.</p>
      </div>
      <div class="residential-vaastu__service-grid">
        <article class="residential-vaastu__service-card">
          <svg class="residential-vaastu__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.6"/></svg>
          <h3 class="residential-vaastu__service-title">Plot &amp; Orientation</h3><p class="residential-vaastu__service-description">Residential plots, house orientation, access, entrances and initial site planning.</p>
        </article>
        <article class="residential-vaastu__service-card">
          <svg class="residential-vaastu__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 21V8l9-5 9 5v13zM8 21v-7h8v7M3 8l9 5 9-5"/></svg>
          <h3 class="residential-vaastu__service-title">Home Layout</h3><p class="residential-vaastu__service-description">Placement of living areas, bedrooms, kitchen and circulation within the home.</p>
        </article>
        <article class="residential-vaastu__service-card">
          <svg class="residential-vaastu__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 21V5h16v16M8 9h3v4H8zm6 0h3v4h-3zM9 21v-4h6v4"/></svg>
          <h3 class="residential-vaastu__service-title">Bedrooms &amp; Key Rooms</h3><p class="residential-vaastu__service-description">Positioning of bedrooms, the pooja room and other key rooms of the home.</p>
        </article>
        <article class="residential-vaastu__service-card">
          <svg class="residential-vaastu__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 21V4h12v17M16 12h4v9M9 12h3M9 16h3M13 21v-5h3"/></svg>
          <h3 class="residential-vaastu__service-title">Entrance &amp; Living Areas</h3><p class="residential-vaastu__service-description">Main entrance, foyer, living room and the movement of family and guests.</p>
        </article>
        <article class="residential-vaastu__service-card">
          <svg class="residential-vaastu__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8l9-5 9 5v8l-9 5-9-5zM3 8l9 5 9-5M12 13v8"/></svg>
          <h3 class="residential-vaastu__service-title">Kitchen, Storage &amp; Utilities</h3><p class="residential-vaastu__service-description">Kitchen, storage rooms, bathrooms, staircase and supporting utilities.</p>
        </article>
        <article class="residential-vaastu__service-card">
          <svg class="residential-vaastu__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 21V8l9-5 9 5v13M8 21v-6h8v6M3 8l9 5 9-5"/><path d="M17 3v5"/></svg>
          <h3 class="residential-vaastu__service-title">Existing Homes</h3><p class="residential-vaastu__service-description">Review of existing spatial arrangements and practical recommendations where feasible.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="residential-vaastu__section residential-vaastu__spaces" id="residential-spaces" aria-labelledby="residential-vaastu-spaces-title">
    <div class="residential-vaastu__container">
      <div class="residential-vaastu__section-heading">
        <div>
          <p class="residential-vaastu__eyebrow">04 / Spaces</p>
          <h2 class="residential-vaastu__title" id="residential-vaastu-spaces-title">Residential Spaces We Serve</h2>
        </div>
        <p>Specialized spatial guidance for homes at every stage, from the plot to the finished house.</p>
      </div>
      <div class="residential-vaastu__space-grid">
        <article class="residential-vaastu__space-card">
          <img src="<?php echo esc_url($rr_rv_image('villa-lawn.jpg')); ?>" alt="<?php esc_attr_e('Villa surrounded by a landscaped garden', 'ravirao-theme'); ?>" loading="lazy" width="1900" height="1263">
          <div><h3 class="residential-vaastu__space-title">Villas &amp; Bungalows</h3><p class="residential-vaastu__space-description">Plots, entrances, gardens and the arrangement of rooms.</p></div>
        </article>
        <article class="residential-vaastu__space-card">
          <img src="<?php echo esc_url($rr_rv_image('house-construction.jpg')); ?>" alt="<?php esc_attr_e('Residential home under construction', 'ravirao-theme'); ?>" loading="lazy" width="1500" height="1000">
          <div><h3 class="residential-vaastu__space-title">Homes Under Construction</h3><p class="residential-vaastu__space-description">Reviewing plans and layouts before and during construction.</p></div>
        </article>
        <article class="residential-vaastu__space-card">
          <img src="<?php echo esc_url($rr_rv_image('house-yellow.jpg')); ?>" alt="<?php esc_attr_e('Independent two-storey home', 'ravirao-theme'); ?>" loading="lazy" width="1500" height="997">
          <div><h3 class="residential-vaastu__space-title">Independent Houses</h3><p class="residential-vaastu__space-description">Entrances, balconies, living areas and everyday spaces.</p></div>
        </article>
      </div>
    </div>
  </section>

  <section class="residential-vaastu__planning" aria-labelledby="residential-vaastu-planning-title">
    <div class="residential-vaastu__container residential-vaastu__planning-layout">
      <div>
        <p class="residential-vaastu__eyebrow residential-vaastu__eyebrow--inverse">An important consideration</p>
        <h2 class="residential-vaastu__title" id="residential-vaastu-planning-title">Plan early. Avoid costly changes later.</h2>
      </div>
      <p>A home is a long-term investment of time and money. <strong>Considering Vaastu at the planning stage</strong> allows recommendations to be reviewed alongside architectural and interior plans — before construction makes changes more difficult.</p>
    </div>
  </section>

  <section class="residential-vaastu__section residential-vaastu__section--cream residential-vaastu__approach" aria-labelledby="residential-vaastu-approach-title">
    <div class="residential-vaastu__container residential-vaastu__approach-layout">
      <div>
        <p class="residential-vaastu__eyebrow">05 / The expert behind the consultation</p>
        <h2 class="residential-vaastu__title" id="residential-vaastu-approach-title">Dr. Ravi Rao’s Approach</h2>
        <p class="residential-vaastu__text">Dr. Ravi Rao brings traditional Vaastu principles into dialogue with the practical requirements of each home. Each consultation considers the plot, the layout, the needs of the family and the opportunities for feasible improvements.</p>
        <ol class="residential-vaastu__steps">
          <li><b class="residential-vaastu__step-number">01</b><div><strong class="residential-vaastu__step-title">Understand the home</strong><span class="residential-vaastu__step-description">Review the plot, layout, family needs and daily routines.</span></div></li>
          <li><b class="residential-vaastu__step-number">02</b><div><strong class="residential-vaastu__step-title">Assess spatial organization</strong><span class="residential-vaastu__step-description">Examine orientation, entrances, rooms and their relationships.</span></div></li>
          <li><b class="residential-vaastu__step-number">03</b><div><strong class="residential-vaastu__step-title">Develop tailored recommendations</strong><span class="residential-vaastu__step-description">Coordinate Vaastu guidance with architects and interior designers as appropriate.</span></div></li>
        </ol>
        <div class="residential-vaastu__expert">
          <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/homepage-design/dr-ravi-rao.jpg')); ?>" alt="<?php esc_attr_e('Dr. Ravi Rao', 'ravirao-theme'); ?>" loading="lazy" width="1000" height="1000">
          <span>Residential Vaastu guidance shaped by the needs of each home. <a href="<?php echo esc_url(home_url('/about-dr-ravi-rao/')); ?>">About Dr. Rao</a></span>
        </div>
      </div>
      <figure class="residential-vaastu__approach-visual">
        <img src="<?php echo esc_url($rr_rv_image('villa-lawn.jpg')); ?>" alt="<?php esc_attr_e('A landscaped home reflecting thoughtful residential planning', 'ravirao-theme'); ?>" loading="lazy" width="1900" height="1263">
        <figcaption>Guidance shaped by the needs of each home.</figcaption>
      </figure>
    </div>
  </section>

  <section class="residential-vaastu__section residential-vaastu__faq-section" aria-labelledby="residential-vaastu-faq-title">
    <div class="residential-vaastu__container residential-vaastu__faq">
      <p class="residential-vaastu__eyebrow">06 / Questions</p>
      <h2 class="residential-vaastu__title" id="residential-vaastu-faq-title">Before you get in touch</h2>
      <details class="residential-vaastu__faq-item">
        <summary class="residential-vaastu__faq-question">Can Vaastu be applied to an apartment or a rented home?</summary>
        <p class="residential-vaastu__faq-answer">Yes. For existing homes the consultation reviews the current arrangement and recommends practical adjustments where feasible.</p>
      </details>
      <details class="residential-vaastu__faq-item">
        <summary class="residential-vaastu__faq-question">Does it replace our architect or interior designer?</summary>
        <p class="residential-vaastu__faq-answer">No. Recommendations are coordinated with architectural and interior requirements and with your project team.</p>
      </details>
      <details class="residential-vaastu__faq-item">
        <summary class="residential-vaastu__faq-question">When is the best time to involve Vaastu?</summary>
        <p class="residential-vaastu__faq-answer">At the planning stage — plot selection and layout planning — before construction begins.</p>
      </details>
      <p class="residential-vaastu__faq-cta"><a class="residential-vaastu__button" href="#business-enquiry">Discuss Your Residential Project <span aria-hidden="true">→</span></a></p>
    </div>
  </section>
</div>
<?php get_footer(); ?>
