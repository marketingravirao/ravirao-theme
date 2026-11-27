<?php
/*
Template Name: Industrial Vaastu
Template Post Type: page
*/
if (!defined('ABSPATH')) {
  exit;
}

/*
 * The YouTube video is enabled by default. Optional page custom fields can replace
 * it: "industrial_vaastu_video", "industrial_vaastu_video_title", and
 * "industrial_vaastu_video_text".
 */
$rr_iv_video_url = trim((string) get_post_meta(get_queried_object_id(), 'industrial_vaastu_video', true));
$rr_iv_video_title = trim((string) get_post_meta(get_queried_object_id(), 'industrial_vaastu_video_title', true));
$rr_iv_video_text = trim((string) get_post_meta(get_queried_object_id(), 'industrial_vaastu_video_text', true));
if (!$rr_iv_video_url) {
  $rr_iv_video_url = 'https://www.youtube.com/watch?v=U71DaPOH0os';
}
if (!$rr_iv_video_title) {
  $rr_iv_video_title = 'Industrial Vaastu Consultation';
}
if (!$rr_iv_video_text) {
  $rr_iv_video_text = 'Watch Dr. Ravi Rao discuss Industrial Vaastu and its application to industrial properties.';
}
$rr_iv_youtube_id = '';
if ($rr_iv_video_url && preg_match('~(?:youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $rr_iv_video_url, $rr_iv_match)) {
  $rr_iv_youtube_id = $rr_iv_match[1];
}
$rr_iv_is_file = $rr_iv_video_url && preg_match('~\.(mp4|webm)(\?.*)?$~i', $rr_iv_video_url);
$rr_iv_has_video = $rr_iv_youtube_id || $rr_iv_is_file;

$rr_iv_img = static function ($file) {
  if (preg_match('~^https?://~i', $file)) {
    return $file;
  }

  return get_theme_file_uri('/assets/images/industrial-vaastu/' . $file);
};
$rr_iv_contact = '#business-enquiry';

get_header();
?>
<div class="industrial-vaastu">
  <section class="industrial-vaastu__hero" aria-labelledby="rr-iv-title">
    <div
      class="industrial-vaastu__container industrial-vaastu__layout industrial-vaastu__layout--two-column industrial-vaastu__hero-content">
      <div>
        <nav class="industrial-vaastu__breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'ravirao-theme'); ?>">
          <a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a> <span
            aria-hidden="true">/</span> <span aria-current="page">Industrial Vaastu</span>
        </nav>
        <p class="industrial-vaastu__eyebrow industrial-vaastu__eyebrow--light">Specialized Vaastu Consultation /
          Industry</p>
        <h1 id="rr-iv-title">Industrial Vaastu <span>Consultation</span></h1>
        <p class="industrial-vaastu__lead">Traditional Vaastu wisdom for modern industrial environments.</p>
        <p class="industrial-vaastu__body-text">Specialized guidance for factories, manufacturing plants, warehouses and
          industrial developments — from site selection to existing-facility assessment.</p>
        <a class="industrial-vaastu__button" href="<?php echo esc_attr($rr_iv_contact); ?>">Discuss Your Industrial
          Project <span aria-hidden="true">→</span></a>
      </div>
      <div class="industrial-vaastu__compass" role="img" aria-label="Vaastu compass around a factory plan">
        <div class="industrial-vaastu__compass-disc"></div>
        <div class="industrial-vaastu__compass-image"></div>
        <svg class="industrial-vaastu__compass-svg" viewBox="0 0 500 500" aria-hidden="true" focusable="false">
          <defs>
            <linearGradient id="rr-iv-sweep" gradientUnits="userSpaceOnUse" x1="250" y1="0" x2="150" y2="0">
              <stop offset="0" stop-color="#e45b47" stop-opacity=".55" />
              <stop offset="1" stop-color="#e45b47" stop-opacity="0" />
            </linearGradient>
          </defs>
          <g id="rr-iv-layer-rings" fill="none" stroke="#fff">
            <circle cx="250" cy="250" r="244" stroke-opacity=".6" />
            <circle cx="250" cy="250" r="224" stroke-opacity=".3" />
            <circle cx="250" cy="250" r="180" stroke-width="1.6" stroke-opacity=".9" />
          </g>
          <g id="rr-iv-layer-ticks" class="industrial-vaastu__compass-ticks industrial-vaastu__compass-ticks--rotating">
            <path
              d="M250.0 26.0L250.0 6.0M272.7 19.1L273.9 7.2M295.3 22.5L297.6 10.7M317.3 28.0L320.8 16.5M335.7 43.1L343.4 24.6M359.4 45.4L365.0 34.8M378.9 57.1L385.6 47.1M397.2 70.7L404.8 61.4M408.4 91.6L422.5 77.5M429.3 102.8L438.6 95.2M442.9 121.1L452.9 114.4M454.6 140.6L465.2 135.0M456.9 164.3L475.4 156.6M472.0 182.7L483.5 179.2M477.5 204.7L489.3 202.4M480.9 227.3L492.8 226.1M474.0 250.0L494.0 250.0M480.9 272.7L492.8 273.9M477.5 295.3L489.3 297.6M472.0 317.3L483.5 320.8M456.9 335.7L475.4 343.4M454.6 359.4L465.2 365.0M442.9 378.9L452.9 385.6M429.3 397.2L438.6 404.8M408.4 408.4L422.5 422.5M397.2 429.3L404.8 438.6M378.9 442.9L385.6 452.9M359.4 454.6L365.0 465.2M335.7 456.9L343.4 475.4M317.3 472.0L320.8 483.5M295.3 477.5L297.6 489.3M272.7 480.9L273.9 492.8M250.0 474.0L250.0 494.0M227.3 480.9L226.1 492.8M204.7 477.5L202.4 489.3M182.7 472.0L179.2 483.5M164.3 456.9L156.6 475.4M140.6 454.6L135.0 465.2M121.1 442.9L114.4 452.9M102.8 429.3L95.2 438.6M91.6 408.4L77.5 422.5M70.7 397.2L61.4 404.8M57.1 378.9L47.1 385.6M45.4 359.4L34.8 365.0M43.1 335.7L24.6 343.4M28.0 317.3L16.5 320.8M22.5 295.3L10.7 297.6M19.1 272.7L7.2 273.9M26.0 250.0L6.0 250.0M19.1 227.3L7.2 226.1M22.5 204.7L10.7 202.4M28.0 182.7L16.5 179.2M43.1 164.3L24.6 156.6M45.4 140.6L34.8 135.0M57.1 121.1L47.1 114.4M70.7 102.8L61.4 95.2M91.6 91.6L77.5 77.5M102.8 70.7L95.2 61.4M121.1 57.1L114.4 47.1M140.6 45.4L135.0 34.8M164.3 43.1L156.6 24.6M182.7 28.0L179.2 16.5M204.7 22.5L202.4 10.7M227.3 19.1L226.1 7.2"
              fill="none" stroke="#fff" stroke-opacity=".6" />
          </g>
          <circle id="rr-iv-layer-dotted-ring"
            class="industrial-vaastu__compass-dots industrial-vaastu__compass-dots--rotating" cx="250" cy="250" r="212"
            fill="none" stroke="#fff" stroke-opacity=".5" stroke-dasharray="2 9" />
          <circle id="rr-iv-layer-ping" class="industrial-vaastu__compass-pulse" cx="250" cy="250" r="180" fill="none"
            stroke="#fff" stroke-width="1.5" />
          <path id="rr-iv-layer-spokes"
            d="M250.0 68.0L250.0 30.0M319.6 81.9L334.2 46.7M378.7 121.3L405.6 94.4M418.1 180.4L453.3 165.8M432.0 250.0L470.0 250.0M418.1 319.6L453.3 334.2M378.7 378.7L405.6 405.6M319.6 418.1L334.2 453.3M250.0 432.0L250.0 470.0M180.4 418.1L165.8 453.3M121.3 378.7L94.4 405.6M81.9 319.6L46.7 334.2M68.0 250.0L30.0 250.0M81.9 180.4L46.7 165.8M121.3 121.3L94.4 94.4M180.4 81.9L165.8 46.7"
            fill="none" stroke="#fff" stroke-opacity=".4" />
          <path id="rr-iv-layer-north-marker" d="M250 2L240 24L260 24Z" fill="#e45b47" />
          <g id="rr-iv-layer-labels" font-size="15" font-weight="700" text-anchor="middle" dominant-baseline="middle">
            <text class="industrial-vaastu__compass-label industrial-vaastu__compass-label--north"
              style="animation-delay:-.8s" x="250.0" y="47.0" fill="#ff8a78">N</text><text
              class="industrial-vaastu__compass-label" style="animation-delay:1.2s" x="393.5" y="106.5"
              fill="#fff">NE</text><text class="industrial-vaastu__compass-label" style="animation-delay:3.2s" x="453.0"
              y="250.0" fill="#fff">E</text><text class="industrial-vaastu__compass-label" style="animation-delay:5.2s"
              x="393.5" y="393.5" fill="#fff">SE</text><text class="industrial-vaastu__compass-label"
              style="animation-delay:7.2s" x="250.0" y="453.0" fill="#fff">S</text><text
              class="industrial-vaastu__compass-label" style="animation-delay:9.2s" x="106.5" y="393.5"
              fill="#fff">SW</text><text class="industrial-vaastu__compass-label" style="animation-delay:11.2s" x="47.0"
              y="250.0" fill="#fff">W</text><text class="industrial-vaastu__compass-label" style="animation-delay:13.2s"
              x="106.5" y="106.5" fill="#fff">NW</text></g>
          <g id="rr-iv-layer-needle"
            class="industrial-vaastu__compass-needle industrial-vaastu__compass-needle--rotating">
            <path d="M250 250L250 100A150 150 0 0 0 153.6 135.1Z" fill="url(#rr-iv-sweep)" />
            <path d="M250 100L258 250L250 262L242 250Z" fill="#e45b47" />
            <path d="M250 400L258 250L250 238L242 250Z" fill="#fff" fill-opacity=".85" />
          </g>
          <g id="rr-iv-layer-hub">
            <circle cx="250" cy="250" r="7" fill="#fff" />
            <circle cx="250" cy="250" r="3" fill="#e45b47" />
          </g>
        </svg>
      </div>
    </div>
  </section>

  <section class="industrial-vaastu__highlights" aria-label="Consultation focus">
    <div class="industrial-vaastu__container rr-reveal-group">
      <div><svg class="industrial-vaastu__icon industrial-vaastu__icon--small" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M4 21V9l8-5 8 5v12z" />
          <path d="M12 11v6M9 14h6" />
        </svg>
        <div><b>New Industrial Developments</b><span>Guidance from site selection to master planning</span></div>
      </div>
      <div><svg class="industrial-vaastu__icon industrial-vaastu__icon--small" viewBox="0 0 24 24" aria-hidden="true">
          <circle cx="10" cy="10" r="6" />
          <path d="M15 15l6 6" />
        </svg>
        <div><b>Existing Facilities</b><span>Assessment and feasible spatial adjustments</span></div>
      </div>
      <div><svg class="industrial-vaastu__icon industrial-vaastu__icon--small" viewBox="0 0 24 24" aria-hidden="true">
          <circle cx="8" cy="9" r="3" />
          <circle cx="17" cy="10" r="2.4" />
          <path d="M2 20c0-3.3 2.7-6 6-6s6 2.7 6 6M15 20c0-2.3 1.4-4 3.5-4.4" />
        </svg>
        <div><b>Project Team Coordination</b><span>Working alongside architects and technical teams</span></div>
      </div>
    </div>
  </section>
  <?php
  get_template_part('template-parts/sections/trusted-brands', null, [
      'id' => 'rr-iv-clients-title',
      'soft' => true,
      'section_class' => 'industrial-vaastu__logo-carousel',
      'heading_class' => 'industrial-vaastu__logo-heading',
      'title_class' => 'industrial-vaastu__logo-title',
      'tagline_class' => 'industrial-vaastu__logo-tagline',
      'track_class' => 'industrial-vaastu__logo-track',
  ]);
  ?>



  <section class="industrial-vaastu__section industrial-vaastu__perspective-section"
    aria-labelledby="rr-iv-perspective">
    <div class="industrial-vaastu__container industrial-vaastu__perspective-flow rr-reveal rr-reveal-left">
      <figure class="industrial-vaastu__feature-figure industrial-vaastu__feature-figure--portrait">
        <img src="<?php echo esc_url('https://rrstaging.ravirao.com/wp-content/uploads/2026/11/download.jpg'); ?>"
          alt="Industrial facility" loading="lazy" width="1400" height="700">
        <figcaption>Site / Structure / Function</figcaption>
      </figure>
      <p class="industrial-vaastu__eyebrow">Industrial Vaastu / The Perspective</p>
      <h2 id="rr-iv-perspective">A factory is more than a building. <em>It is an interconnected system</em></h2>
      <div class="industrial-vaastu__perspective-intro">
        <p class="industrial-vaastu__body-text industrial-vaastu__perspective-copy">Every industrial property brings
          together land, structures, machinery, materials, people and processes. In the Vaastu tradition, their
          orientation and arrangement are considered in relation to the purpose of the facility.</p>
        <p class="industrial-vaastu__body-text industrial-vaastu__perspective-copy">Dr. Ravi Rao provides Industrial
          Vaastu consultations tailored to the operational realities of each enterprise, combining traditional spatial
          principles with the practical requirements of industrial planning. Although processes vary across industries,
          the fundamental principles of Vaastu Shastra remain universally applicable.</p>
      </div>
      <div class="industrial-vaastu__perspective-more" id="rr-iv-perspective-more">
        <p class="industrial-vaastu__body-text industrial-vaastu__perspective-copy">Drawing on his profound knowledge of
          ancient Vedic science, Dr. Ravi Rao offers solutions to revive struggling industries, strengthen existing
          businesses and support new industrial ventures. His accurate predictions and insights combine logical
          analysis, traditional wisdom and intuitive ability.</p>
        <p class="industrial-vaastu__body-text industrial-vaastu__perspective-copy">His consultations involve a
          comprehensive assessment of every aspect of an industrial facility — from selecting the right plot and
          determining building orientation to planning production areas, positioning machinery, managing raw material
          storage, locating utilities and security facilities, and choosing appropriate colour schemes. Every detail is
          examined to identify and eliminate Vaastu defects.</p>
        <p class="industrial-vaastu__body-text industrial-vaastu__perspective-copy">Establishing a successful industry
          requires substantial investment and the coordination of many activities — from land acquisition and
          infrastructure development to material procurement, workforce management and production planning. To achieve
          smooth operations, consistent production, steady profits and sustained growth, industrial structures must be
          free from Vaastu defects. Vaastu Shastra harmonises these interconnected elements, supporting operational
          stability, productivity and long-term profitability as the foundation for lasting commercial success.</p>
      </div>
      <button class="industrial-vaastu__button industrial-vaastu__perspective-toggle" type="button"
        aria-controls="rr-iv-perspective-more" aria-expanded="true" hidden>View more</button>
    </div>
  </section>

  <?php if ($rr_iv_has_video): ?>
    <section class="industrial-vaastu__section industrial-vaastu__video-section" id="video"
      aria-labelledby="rr-iv-video-title">
      <div class="industrial-vaastu__container">
        <div class="industrial-vaastu__section-heading">
          <div>
            <p class="industrial-vaastu__eyebrow industrial-vaastu__eyebrow--light">Video</p>
            <h2 id="rr-iv-video-title">Industrial Vaastu on video</h2>
          </div>
          <?php if ($rr_iv_video_text): ?>
            <p><?php echo esc_html($rr_iv_video_text); ?></p><?php endif; ?>
        </div>
        <div class="industrial-vaastu__video-frame rr-reveal rr-reveal-scale">
          <?php if ($rr_iv_youtube_id): ?>
            <iframe src="<?php echo esc_url('https://www.youtube-nocookie.com/embed/' . $rr_iv_youtube_id); ?>"
              title="<?php echo esc_attr($rr_iv_video_title ?: 'Industrial Vaastu video'); ?>" loading="lazy"
              allow="accelerometer; encrypted-media; picture-in-picture" allowfullscreen></iframe>
          <?php else: ?>
            <video src="<?php echo esc_url($rr_iv_video_url); ?>" poster="<?php echo esc_url($rr_iv_img('hall.jpg')); ?>"
              controls playsinline preload="metadata"></video>
          <?php endif; ?>
        </div>
        <?php if ($rr_iv_video_title): ?>
          <p class="industrial-vaastu__video-caption"><?php echo esc_html($rr_iv_video_title); ?></p><?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <section class="industrial-vaastu__section industrial-vaastu__section--cream" id="services"
    aria-labelledby="rr-iv-scope">
    <div class="industrial-vaastu__container">
      <div class="industrial-vaastu__section-heading">
        <div>
          <p class="industrial-vaastu__eyebrow">Scope of consultation</p>
          <h2 id="rr-iv-scope">Every part of the facility<br>has its place</h2>
        </div>
        <p class="industrial-vaastu__body-text">The consultation considers the property as a whole, while addressing the
          functional requirements of each area.</p>
      </div>
      <div class="industrial-vaastu__service-grid rr-reveal-group">
        <div class="industrial-vaastu__service-card"><svg class="industrial-vaastu__icon" viewBox="0 0 24 24"
            aria-hidden="true">
            <path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z" />
            <circle cx="12" cy="10" r="2.6" />
          </svg>
          <h3>Site Selection &amp; Orientation</h3>
          <p>Industrial plots, land characteristics, access, building orientation and initial site planning.</p>
        </div>
        <div class="industrial-vaastu__service-card"><svg class="industrial-vaastu__icon" viewBox="0 0 24 24"
            aria-hidden="true">
            <path d="M3 21V10l6 4v-4l6 4V6h3v15z" />
            <path d="M7 18h1.5M12 18h1.5M16 18h1" />
          </svg>
          <h3>Factory &amp; Plant Layout</h3>
          <p>Placement of production zones, buildings, departments and circulation areas.</p>
        </div>
        <div class="industrial-vaastu__service-card"><svg class="industrial-vaastu__icon" viewBox="0 0 24 24"
            aria-hidden="true">
            <circle cx="12" cy="12" r="3" />
            <circle cx="12" cy="12" r="6.5" />
            <path
              d="M12 2.5v3M12 18.5v3M2.5 12h3M18.5 12h3M5.3 5.3l2.1 2.1M16.6 16.6l2.1 2.1M18.7 5.3l-2.1 2.1M7.4 16.6l-2.1 2.1" />
          </svg>
          <h3>Machinery &amp; Equipment</h3>
          <p>Assessment of machinery locations and their relationship to functional zones.</p>
        </div>
        <div class="industrial-vaastu__service-card"><svg class="industrial-vaastu__icon" viewBox="0 0 24 24"
            aria-hidden="true">
            <path d="M3 8l9-5 9 5v8l-9 5-9-5z" />
            <path d="M3 8l9 5 9-5M12 13v8" />
          </svg>
          <h3>Storage &amp; Material Flow</h3>
          <p>Raw-material storage, finished goods, warehouses, loading and dispatch areas.</p>
        </div>
        <div class="industrial-vaastu__service-card"><svg class="industrial-vaastu__icon" viewBox="0 0 24 24"
            aria-hidden="true">
            <path d="M13 2L4 14h7l-1 8 9-12h-7z" />
          </svg>
          <h3>Utilities &amp; Infrastructure</h3>
          <p>Water facilities, electrical installations, entrances and supporting infrastructure.</p>
        </div>
        <div class="industrial-vaastu__service-card"><svg class="industrial-vaastu__icon" viewBox="0 0 24 24"
            aria-hidden="true">
            <rect x="5" y="4" width="14" height="17" rx="2" />
            <path d="M9 4V3h6v1M9 13l2.2 2.2 4.3-4.4" />
          </svg>
          <h3>Existing Industrial Units</h3>
          <p>Review of existing spatial arrangements and practical recommendations where feasible.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="industrial-vaastu__section" id="sectors" aria-labelledby="rr-iv-sectors">
    <div class="industrial-vaastu__container">
      <div class="industrial-vaastu__section-heading">
        <div>
          <p class="industrial-vaastu__eyebrow">Industries</p>
          <h2 id="rr-iv-sectors">Where Industrial Vaastu Applies</h2>
        </div>
        <p class="industrial-vaastu__body-text">Specialized spatial guidance for diverse industrial environments, from
          production and processing to storage and distribution.</p>
      </div>
      <div class="industrial-vaastu__sector-grid rr-reveal-group">
        <?php
        $rr_iv_sectors = [
          ['robots.jpg', 'Automotive Manufacturing', 'Assembly lines, production facilities, machinery and plant layouts. An efficient Vaastu layout streamlines production, reduces material wastage and improves machinery performance, supporting productivity and profitability.', 'featured'],
          ['https://rrstaging.ravirao.com/wp-content/uploads/2026/11/Pharma-scaled.jpg', 'Pharmaceutical Industry', 'Manufacturing units, laboratories, storage and utility zones. From raw materials to packaging, proper Vaastu ensures a harmonious working environment and supports efficiency, safety, quality and profitability.', 'vertical'],
          ['https://rrstaging.ravirao.com/wp-content/uploads/2026/11/textile-scaled.jpg', 'Textile Manufacturing', 'Textile mills, processing units, machinery and material flow. Vaastu-compliant entrances, layouts and machinery placement improve workflow, increase output and minimize breakdowns for consistent productivity.'],
          ['https://rrstaging.ravirao.com/wp-content/uploads/2026/11/Food-scaled.jpg', 'Food Processing', 'Processing facilities, storage areas and production infrastructure. Proper Vaastu planning enhances cleanliness, hygiene and efficiency, supporting employee well-being, product quality and profitability.', 'tinted'],
          ['https://rrstaging.ravirao.com/wp-content/uploads/2026/11/Paper-scaled.jpg', 'Paper & Packaging', 'Manufacturing plants, heavy machinery and warehouse planning. Strategic Vaastu planning optimizes machinery placement, raw material storage and production flow, reducing disruptions and improving resource utilization and profitability.'],
          ['https://rrstaging.ravirao.com/wp-content/uploads/2026/11/Logistics-scaled.jpg', 'Warehousing & Logistics', 'Distribution centers, loading areas, storage and dispatch zones. Correct Vaastu placement of entrances, exits, warehouses and offices ensures smooth goods movement, timely distribution and business prosperity.', 'wide'],
        ];
        foreach ($rr_iv_sectors as $rr_iv_sector):
          ?>
          <article
            class="industrial-vaastu__sector-card<?php if (!empty($rr_iv_sector[3])): ?> industrial-vaastu__sector-card--<?php echo esc_attr($rr_iv_sector[3]); ?><?php endif; ?>">
            <div class="industrial-vaastu__sector-image">
              <img src="<?php echo esc_url($rr_iv_img($rr_iv_sector[0])); ?>" alt="" loading="lazy" width="1400"
                height="700">
            </div>
            <div class="industrial-vaastu__sector-content">
              <h3><?php echo esc_html($rr_iv_sector[1]); ?></h3>
              <p><?php echo esc_html($rr_iv_sector[2]); ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="industrial-vaastu__planning-banner" aria-labelledby="rr-iv-plan">
    <div class="industrial-vaastu__container">
      <div>
        <p class="industrial-vaastu__eyebrow industrial-vaastu__eyebrow--inverse">An important consideration</p>
        <h2 id="rr-iv-plan">Plan early. Avoid costly changes later</h2>
      </div>
      <p>Industrial layouts involve substantial long-term investment. <strong>Considering Vaastu at the planning
          stage</strong> allows recommendations to be reviewed alongside architectural, safety and operational
        requirements — before construction and machinery placement make changes more difficult.</p>
    </div>
  </section>

  <section class="industrial-vaastu__section industrial-vaastu__section--cream" aria-labelledby="rr-iv-approach">
    <div class="industrial-vaastu__container industrial-vaastu__layout industrial-vaastu__layout--two-column">
      <div class="rr-reveal rr-reveal-left">
        <p class="industrial-vaastu__eyebrow">The expert behind the consultation</p>
        <h2 id="rr-iv-approach">Dr. Ravi Rao’s Approach</h2>
        <p class="industrial-vaastu__body-text">Dr. Ravi Rao brings traditional Vaastu principles into dialogue with the
          practical requirements of industrial projects. Each consultation considers the site, the operational purpose
          of the facility, its architectural layout and the opportunities for feasible improvements.</p>
        <ol class="industrial-vaastu__steps">
          <li><b>01</b>
            <div><strong>Understand the facility</strong><span>Review the site, purpose, layout and operational
                requirements.</span></div>
          </li>
          <li><b>02</b>
            <div><strong>Assess spatial organization</strong><span>Examine orientation, functional areas, infrastructure
                and their relationships.</span></div>
          </li>
          <li><b>03</b>
            <div><strong>Develop tailored recommendations</strong><span>Coordinate Vaastu guidance with architectural
                and technical teams as appropriate.</span></div>
          </li>
        </ol>
        <div class="industrial-vaastu__expert">
          <span>Dr. Ravi Rao is an Astro-Vaastu consultant with more than 35+ years of experience guiding organizations and industries. <a
              href="<?php echo esc_url(home_url('/about-dr-ravi-rao/')); ?>">About Dr. Rao</a></span>
        </div>
      </div>
      <figure class="industrial-vaastu__approach-visual rr-reveal rr-reveal-right">
        <img src="<?php echo esc_url($rr_iv_img('approach-scene.svg')); ?>"
          alt="Animated industrial blueprint showing a factory plan, compass, machinery and production flow"
          loading="lazy" width="600" height="560">
        <figcaption class="industrial-vaastu__approach-caption">Guidance shaped by the needs of each project.</figcaption>
      </figure>
    </div>
  </section>

  <?php
  get_template_part('template-parts/sections/industry-testimonials', null, [
      'id' => 'rr-iv-industry-testimonials-title',
      'section_class' => 'industrial-vaastu__testimonials',
  ]);
  ?>

  <section class="industrial-vaastu__section" aria-labelledby="industrial-vaastu__faq">
    <div class="industrial-vaastu__container industrial-vaastu__faq">
      <p class="industrial-vaastu__eyebrow">Questions</p>
      <h2 id="industrial-vaastu__faq">Before you get in touch</h2>
      <details>
        <summary>Can Vaastu be applied to an existing factory?</summary>
        <p>Yes. For existing units the consultation reviews the current arrangement and recommends practical adjustments
          where feasible.</p>
      </details>
      <details>
        <summary>Does it replace our architects and engineers?</summary>
        <p>No. Recommendations are coordinated with architectural, technical and safety requirements and with your
          project team.</p>
      </details>
      <details>
        <summary>When is the best time to involve Vaastu?</summary>
        <p>At the planning stage — site selection and master planning — before construction and machinery placement.</p>
      </details>
      <p class="industrial-vaastu__faq-cta"><a class="industrial-vaastu__button"
          href="<?php echo esc_attr($rr_iv_contact); ?>">Discuss Your Industrial Project <span
            aria-hidden="true">→</span></a></p>
    </div>
  </section>
</div>
<?php get_footer(); ?>

