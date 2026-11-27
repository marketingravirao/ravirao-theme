<?php
if (!defined('ABSPATH')) {
    exit;
}

$section_args = wp_parse_args($args ?? [], [
    'variant' => 'default',
    'id' => 'rr-trusted-brands',
    'title' => 'Trusted by Leading Brands',
    'tagline' => 'Organizations across industries have placed their trust in Dr. Ravi Rao’s Vaastu expertise.',
    'soft' => false,
    'reveal_heading' => false,
    'section_class' => '',
    'heading_class' => '',
    'title_class' => '',
    'tagline_class' => '',
    'track_class' => '',
]);

$client_logos = [
    ['Adani-Logo.png', 'Adani'],
    ['Arvind-Logo.png', 'Arvind'],
    ['CERA-logo.png', 'CERA'],
    ['Havmor-logo.png', 'Havmor'],
    ['RKumar-logo.png', 'R Kumar'],
    ['Shobha-logo.png', 'Shobha Asar'],
    ['Sintex-logo.png', 'Sintex'],
    ['Somnay-logo.png', 'Somany'],
    ['vadilal-logo.png', 'Vadilal'],
];

if ($section_args['variant'] === 'homepage-design') :
    ?>
    <section class="trust" id="trust">
      <div class="wrap">
        <div class="trust-top">
          <b>Corporate experience &amp; client relationships</b>
          <i></i>
        </div>
        <div class="logo-marquee" role="group" aria-label="Client logos">
          <div class="logo-track">
            <?php foreach ([false, true] as $is_duplicate) : ?>
              <ul class="lm-set"<?php if ($is_duplicate) : ?> aria-hidden="true"<?php endif; ?>>
                <?php foreach ($client_logos as [$image, $name]) : ?>
                  <li>
                    <img src="<?php echo esc_url(content_url('/uploads/2025/07/' . $image)); ?>"
                      alt="<?php echo $is_duplicate ? '' : esc_attr($name); ?>"
                      data-n="<?php echo esc_attr($name); ?>"
                      height="48" loading="lazy" decoding="async">
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
    <?php
    return;
endif;

$section_classes = array_filter([
    'infinite-logo-carousel',
    'rr-section',
    $section_args['soft'] ? 'rr-section-soft' : '',
    $section_args['section_class'],
]);
$heading_classes = trim('rr-section-heading ' . $section_args['heading_class']);
$title_classes = trim('rr-section-title ' . $section_args['title_class']);
$tagline_classes = trim('rr-section-tagline ' . $section_args['tagline_class']);
$track_classes = trim('carousel-track ' . $section_args['track_class']);
?>
<section class="<?php echo esc_attr(implode(' ', $section_classes)); ?>"
  aria-labelledby="<?php echo esc_attr($section_args['id']); ?>">
  <div class="<?php echo esc_attr($heading_classes); ?>"<?php if ($section_args['reveal_heading']) : ?> data-reveal<?php endif; ?>>
    <h2 class="<?php echo esc_attr($title_classes); ?>"
      id="<?php echo esc_attr($section_args['id']); ?>"><?php echo esc_html($section_args['title']); ?></h2>
    <p class="<?php echo esc_attr($tagline_classes); ?>"><?php echo esc_html($section_args['tagline']); ?></p>
  </div>
  <div class="<?php echo esc_attr($track_classes); ?>" aria-label="<?php esc_attr_e('Client organizations', 'ravirao-theme'); ?>">
    <?php foreach ([false, true] as $is_duplicate) : ?>
      <?php foreach ($client_logos as [$image, $name]) : ?>
        <img src="<?php echo esc_url(content_url('/uploads/2025/07/' . $image)); ?>"
          alt="<?php echo $is_duplicate ? '' : esc_attr($name); ?>"
          <?php if ($is_duplicate) : ?>aria-hidden="true"<?php endif; ?>
          loading="lazy" decoding="async">
      <?php endforeach; ?>
    <?php endforeach; ?>
  </div>
</section>
