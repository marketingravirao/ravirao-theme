<?php
if (!defined('ABSPATH')) {
    exit;
}

$section_args = wp_parse_args($args ?? [], [
    'variant' => 'default',
    'id' => 'rr-industry-testimonials',
    'title' => 'What Industry Leaders Say About Dr. Rao’s Vaastu Expertise',
    'reveal_heading' => false,
    'section_class' => '',
    'heading_class' => 'rr-section-heading',
    'eyebrow' => '',
    'eyebrow_class' => '',
    'title_class' => 'testimonial-section-main-heading rr-section-title',
    'grid_class' => 'testimonials-cards-handdrawn rr-container',
    'card_class' => 'testimonial-card-sketch rr-card',
    'card_reveal_class' => '',
    'card_heading_class' => 'testimonial-card-heading highlight',
    'quote_class' => 'testimonial-card-quote-block',
    'text_class' => 'testimonial-card-text',
    'profile_class' => 'testimonial-card-profile',
    'meta_class' => 'testimonial-card-meta',
    'name_class' => 'testimonial-card-name',
    'role_class' => 'testimonial-card-role',
    'simple_profile' => false,
]);

$testimonials = $section_args['variant'] === 'homepage-design'
    ? [
        [
            'title' => 'Results after Vaastu correction',
            'quote' => 'Before coming into contact with Dr. Rao our office had few clients and lesser inquiries. After we changed our office as per Dr. Rao’s instructions, we started getting more clients and lots of phone inquiries.',
            'name' => 'Manufacturer of Footwear',
            'role' => 'Industry client',
        ],
        [
            'title' => 'Business growth through branding',
            'quote' => 'When Dr. Rao saw our logo he felt there was a serious mismatch between our line of business and the colors and balance within the logo. After we adopted his suggestions, this change became very significant to our business fortunes.',
            'name' => 'Owner, Office Furniture Systems Design & Manufacturing',
            'role' => 'Client',
        ],
        [
            'title' => 'Expert guidance & clarity',
            'quote' => 'The best part of Dr. Rao, if I may say so, is three characteristics. The first is clarity in explaining Vaastu, the second is his convincing ability, and finally, his patient listening to our expectations.',
            'name' => 'Business Owner, BPO',
            'role' => 'Corporate client',
        ],
        [
            'title' => 'Mentorship & professional guidance',
            'quote' => 'I often remember the great time I spent with you and your team. Your way of handling projects and the top-notch exposure with premium clients that I got while working with you and your team members have helped me to set the vision and approach right. I shall always be obliged to you, Sir. I always see you as a fantastic mentor and guide!',
            'name' => 'Mudassar M. Shaikh',
            'role' => 'Senior Healthcare Architect, INI Design Studio, Ahmedabad',
        ],
        [
            'title' => 'A kind-hearted, positive approach',
            'quote' => 'Excellent approach, a kind-hearted person, and very friendly staff. Despite being a very busy person, Dr. Rao always maintains such a positive approach. I personally thank him and his entire office team.',
            'name' => 'Mr. Nilesh Rajanikant Desai',
            'role' => 'Director and Honorary Joint Secretary, Managing Committee, Karnavati Club, Ahmedabad',
        ],
    ]
    : [
        [
            'title' => 'Results After Vaastu Correction',
            'quote' => '“Before coming into contact with Dr. Rao our office had few clients and lesser inquiries. After we changed our office as per Dr. Rao’s instructions, we started getting more clients and lots of phone inquiries.”',
            'name' => 'Manufacturer of Footwear',
            'role' => 'Industry Client',
        ],
        [
            'title' => 'Business Growth Through Branding',
            'quote' => '“When Dr. Rao saw our logo he felt there was a serious mismatch between our line of business and the colors and balance within the logo. After we adopted his suggestions, this change became very significant to our business fortunes.”',
            'name' => 'Owner of Office Furniture Systems',
            'role' => 'Design/Manufacturing Client',
        ],
        [
            'title' => 'Expert Guidance & Clarity',
            'quote' => '“The best part of Dr. Rao, if I may say so, is three characteristics. The first is clarity in explaining Vaastu, the second is his convincing ability, and finally, his patient listening to our expectations.”',
            'name' => 'Business Owner of BPO',
            'role' => 'Corporate Client',
        ],
        [
            'title' => 'Mentorship & Professional Guidance',
            'quote' => '«I often remember the great time I spent with you and your team. Your way of handling projects and the top-notch exposure with premium clients that I got while working with you and your team members have helped me to set the vision and approach right. I shall always be obliged to you, Sir. I always see you as a fantastic mentor and guide!»',
            'name' => 'Mudassar M. Shaikh',
            'role' => 'Senior Healthcare Architect, INI Design Studio, Ahmedabad',
        ],
        [
            'title' => 'A Kind-Hearted, Positive Approach',
            'quote' => '“Excellent approach, a kind-hearted person, and very friendly staff. Despite being a very busy person, Dr. Rao always maintains such a positive approach. I personally thank him and his entire office team.”',
            'name' => 'Mr. Nilesh Rajanikant Desai',
            'role' => 'Director and Honorary Joint Secretary, Managing Committee, Karnavati Club, Ahmedabad',
        ],
    ];

// Reviews are shown in a Swiper slider (see ravirao_theme_enqueue_reviews_slider() in functions.php).
ravirao_theme_enqueue_reviews_slider();

$rr_reviews_controls = static function () {
    ?>
    <div class="rr-reviews-slider__controls">
      <button class="rr-reviews-slider__arrow rr-reviews-slider__prev" type="button" aria-label="<?php esc_attr_e('Previous review', 'ravirao-theme'); ?>">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M15 5l-7 7 7 7" /></svg>
      </button>
      <div class="rr-reviews-slider__pagination"></div>
      <button class="rr-reviews-slider__arrow rr-reviews-slider__next" type="button" aria-label="<?php esc_attr_e('Next review', 'ravirao-theme'); ?>">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M9 5l7 7-7 7" /></svg>
      </button>
    </div>
    <?php
};

if ($section_args['variant'] === 'homepage-design') :
    ?>
    <section class="section testi" id="testimonials" aria-labelledby="testimonials-heading">
      <div class="wrap section-heading">
        <div>
          <div class="eyebrow">06 / Client perspectives</div>
          <h2 class="serif" id="testimonials-heading">What industry leaders say about Dr. Rao’s Vaastu expertise</h2>
        </div>
      </div>
      <div class="wrap testi-grid">
        <div class="rr-reviews-slider" data-rr-reviews-slider>
          <div class="swiper rr-reviews-slider__viewport">
            <div class="swiper-wrapper">
              <?php foreach ($testimonials as $testimonial) : ?>
                <figure class="tq swiper-slide">
                  <span class="tq-mark" aria-hidden="true">“</span>
                  <figcaption class="tq-title"><?php echo esc_html($testimonial['title']); ?></figcaption>
                  <blockquote><?php echo esc_html($testimonial['quote']); ?></blockquote>
                  <div class="tq-by">
                    <b><?php echo esc_html($testimonial['name']); ?></b>
                    <span><?php echo esc_html($testimonial['role']); ?></span>
                  </div>
                </figure>
              <?php endforeach; ?>
            </div>
          </div>
          <?php $rr_reviews_controls(); ?>
        </div>
      </div>
    </section>
    <?php
    return;
endif;
?>
<section class="<?php echo esc_attr(trim('testimonials-section-handdrawn rr-section ' . $section_args['section_class'])); ?>"
  aria-labelledby="<?php echo esc_attr($section_args['id']); ?>">
  <div class="<?php echo esc_attr($section_args['heading_class']); ?>"<?php if ($section_args['reveal_heading']) : ?> data-reveal<?php endif; ?>>
    <?php if ($section_args['eyebrow']) : ?>
      <p class="<?php echo esc_attr($section_args['eyebrow_class']); ?>"><?php echo esc_html($section_args['eyebrow']); ?></p>
    <?php endif; ?>
    <h2 class="<?php echo esc_attr($section_args['title_class']); ?>"
      id="<?php echo esc_attr($section_args['id']); ?>"><?php echo esc_html($section_args['title']); ?></h2>
  </div>
  <div class="<?php echo esc_attr($section_args['grid_class']); ?>" data-reveal-group>
    <div class="rr-reviews-slider" data-rr-reviews-slider>
    <div class="swiper rr-reviews-slider__viewport">
    <div class="swiper-wrapper">
    <?php foreach ($testimonials as $testimonial) : ?>
      <figure class="<?php echo esc_attr(trim($section_args['card_class'] . ' ' . $section_args['card_reveal_class'] . ' swiper-slide')); ?>">
        <h3 class="<?php echo esc_attr($section_args['card_heading_class']); ?>"><?php echo esc_html($testimonial['title']); ?></h3>
        <blockquote class="<?php echo esc_attr($section_args['quote_class']); ?>">
          <span class="<?php echo esc_attr($section_args['text_class']); ?>"><?php echo esc_html($testimonial['quote']); ?></span>
        </blockquote>
        <figcaption class="<?php echo esc_attr($section_args['profile_class']); ?>">
          <?php if ($section_args['simple_profile']) : ?>
            <strong class="<?php echo esc_attr($section_args['name_class']); ?>"><?php echo esc_html($testimonial['name']); ?></strong>
            <span class="<?php echo esc_attr($section_args['role_class']); ?>"><?php echo esc_html($testimonial['role']); ?></span>
          <?php else : ?>
            <span class="<?php echo esc_attr($section_args['meta_class']); ?>">
              <strong class="<?php echo esc_attr($section_args['name_class']); ?>"><?php echo esc_html($testimonial['name']); ?></strong>
              <span class="<?php echo esc_attr($section_args['role_class']); ?>"><?php echo esc_html($testimonial['role']); ?></span>
            </span>
          <?php endif; ?>
        </figcaption>
      </figure>
    <?php endforeach; ?>
    </div>
    </div>
    <?php $rr_reviews_controls(); ?>
    </div>
  </div>
</section>
