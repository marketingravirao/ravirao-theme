<?php
if (!defined('ABSPATH')) { exit; }

$books = [
    [
        'image' => 'tmp0_dj6iey.webp',
        'alt' => "A Nation's Prophecy book cover",
        'title' => "A Nation's Prophecy",
        'description' => 'India’s first book on Mundane Astrology: predictions for 202+ countries, global economic trends, and astrological insights by Dr. Ravi Rao.',
        'url' => 'https://www.amazon.in/dp/8192304965',
    ],
    [
        'image' => 'tmpjih9ehyu.webp',
        'alt' => 'Sports Astrology book cover',
        'title' => 'Sports Astrology',
        'description' => 'Discover how astrology predicts match outcomes, analyzes team charts, and offers insights for sports fans and professionals.',
        'url' => 'https://www.amazon.in/dp/8192935809',
    ],
    [
        'image' => 'tmpmt4w2i_l.webp',
        'alt' => 'Vaastu Made Simple book cover',
        'title' => 'Vaastu Made Simple',
        'description' => 'A practical guide to harmonious living, Vaastu basics, and easy remedies for homes and workplaces.',
        'url' => 'https://www.amazon.in/dp/B0CLYF3K43',
    ],
];

$media = [
    ['8o_JVu6ftks', '1', 'Dr. Ravi Rao’s Journey'],
    ['MvjAWxnYfTY', '4', 'Featured media appearance'],
    ['6WlCHPfsXa8', '5', 'Vaastu insights'],
    ['_Ru1pl4Saow', '8', 'Featured media appearance'],
];

$blogs = [
    [
        'date' => 'July 3, 2024',
        'title' => 'From Soil to Soul: The Untold Power of Bhoomi Poojan in Vastu Shastra',
        'description' => 'Discover why Bhoomi Poojan is the spiritual foundation of every auspicious construction and how it connects the energies of land, cosmos, and you.',
        'url' => 'https://rrstaging.ravirao.com/from-soil-to-soul-the-untold-power-of-bhoomi-poojan-in-vastu-shastra/',
    ],
    [
        'date' => 'July 2, 2024',
        'title' => 'Not Your Home? Not a Problem: Vastu Hacks for Rented Spaces That Actually Work',
        'description' => 'Practical and effective Vastu tips for tenants—bring harmony and success even when you cannot renovate your space completely.',
        'url' => 'https://rrstaging.ravirao.com/not-your-home-not-a-problem-vastu-hacks-for-rented-spaces-that-actually-work/',
    ],
    [
        'date' => 'July 1, 2024',
        'title' => 'Hidden Wealth: How Vastu-Compliant Storage Can Boost Factory Output and Harmony',
        'description' => 'Unlock the secrets of storage placement as per Vastu—improve productivity, cash flow, and relationships at your workplace or factory.',
        'url' => 'https://rrstaging.ravirao.com/hidden-wealth-how-vastu-compliant-storage-can-boost-factory-output-and-harmony/',
    ],
];

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

$testimonials = [
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
];

get_header();
?>
<main class="ravirao-homepage rr-about-publications-page">
  <section class="rr-publications-books rr-section-soft" aria-labelledby="rr-publications-title">
    <div class="rr-publications-books-inner rr-container">
      <header class="rr-publications-books-heading rr-reveal rr-reveal-up">
        <p class="rr-about-dr-eyebrow">Books &amp; publications</p>
        <h1 id="rr-publications-title">Explore Dr. Ravi Rao’s Bestselling Books</h1>
        <p>Research and practical perspectives on astrology, sport, and Vaastu.</p>
      </header>
      <div class="rr-publications-book-grid">
        <?php foreach ($books as $book) : ?>
          <article class="rr-publications-book rr-reveal rr-reveal-up">
            <div class="rr-publications-book-cover">
              <img src="<?php echo esc_url(content_url('/uploads/2025/06/' . $book['image'])); ?>" alt="<?php echo esc_attr($book['alt']); ?>" loading="lazy">
            </div>
            <div class="rr-publications-book-content">
              <h2><?php echo esc_html($book['title']); ?></h2>
              <p><?php echo esc_html($book['description']); ?></p>
              <a class="rr-button" href="<?php echo esc_url($book['url']); ?>" target="_blank" rel="noopener noreferrer">Buy on Amazon <span aria-hidden="true">↗</span></a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="vaastu-heading-section rr-section" aria-labelledby="rr-publications-media-title">
    <div class="rr-section-heading" data-reveal>
      <h2 class="vaastu-heading-main rr-section-title" id="rr-publications-media-title">Featured in the Media: Dr. Ravi Rao’s Journey</h2>
    </div>
    <div class="vaastu-featured-media-videos rr-container" data-reveal-group>
      <?php foreach ($media as [$video_id, $playlist_index, $caption]) : ?>
        <div class="vaastu-featured-media-video">
          <div class="vaastu-featured-media-video-frame">
            <button class="vaastu-featured-media-play" type="button" data-youtube-id="<?php echo esc_attr($video_id); ?>" data-youtube-index="<?php echo esc_attr($playlist_index); ?>" aria-label="Play <?php echo esc_attr($caption); ?>">
              <img src="https://img.youtube.com/vi/<?php echo esc_attr($video_id); ?>/hqdefault.jpg" alt="" loading="lazy" decoding="async">
              <span class="vaastu-featured-media-play-icon" aria-hidden="true"></span>
            </button>
          </div>
          <p class="vaastu-featured-media-caption"><?php echo esc_html($caption); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="vaastu-blogs-section rr-section" aria-labelledby="rr-publications-blogs-title">
    <div class="rr-section-heading" data-reveal>
      <h2 class="vaastu-blogs-title rr-section-title" id="rr-publications-blogs-title">Dr. Ravi Rao Blogs</h2>
    </div>
    <div class="vaastu-blogs-cards rr-container" data-reveal-group>
      <?php foreach ($blogs as $blog) : ?>
        <article class="vaastu-blog-card rr-card">
          <p class="vaastu-blog-date"><?php echo esc_html($blog['date']); ?></p>
          <h3 class="vaastu-blog-title"><?php echo esc_html($blog['title']); ?></h3>
          <p class="vaastu-blog-desc"><?php echo esc_html($blog['description']); ?></p>
          <div class="vaastu-blog-footer">
            <span class="vaastu-blog-author">Dr. Ravi Rao</span>
            <a class="vaastu-blog-link" href="<?php echo esc_url($blog['url']); ?>" target="_blank" rel="noopener noreferrer">Read More</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="vaastu-blogs-more">
      <a class="rr-button vaastu-blogs-more-btn" href="https://rrstaging.ravirao.com/category/vaastu/" target="_blank" rel="noopener noreferrer">Explore More Vaastu Blogs</a>
    </div>
  </section>

  <section class="infinite-logo-carousel rr-section" aria-labelledby="rr-publications-clients-title">
    <div class="rr-section-heading" data-reveal>
      <h2 class="rr-section-title" id="rr-publications-clients-title">Trusted by Leading Brands</h2>
      <p class="rr-section-tagline">Organizations across industries have placed their trust in Dr. Ravi Rao’s Vaastu expertise.</p>
    </div>
    <div class="carousel-track" aria-label="Client organizations">
      <?php foreach ([false, true] as $is_duplicate) : ?>
        <?php foreach ($client_logos as [$image, $name]) : ?>
          <img src="<?php echo esc_url(content_url('/uploads/2025/07/' . $image)); ?>" alt="<?php echo $is_duplicate ? '' : esc_attr($name); ?>" <?php echo $is_duplicate ? 'aria-hidden="true"' : ''; ?> loading="lazy">
        <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="testimonials-section-handdrawn rr-section" aria-labelledby="rr-publications-testimonials-title">
    <div class="rr-section-heading" data-reveal>
      <h2 class="testimonial-section-main-heading rr-section-title" id="rr-publications-testimonials-title">What Industry Leaders Say About Dr. Rao’s Vaastu Expertise</h2>
    </div>
    <div class="testimonials-cards-handdrawn rr-container" data-reveal-group>
      <?php foreach ($testimonials as $testimonial) : ?>
        <figure class="testimonial-card-sketch rr-card">
          <h3 class="testimonial-card-heading highlight"><?php echo esc_html($testimonial['title']); ?></h3>
          <blockquote class="testimonial-card-quote-block"><span class="testimonial-card-text"><?php echo esc_html($testimonial['quote']); ?></span></blockquote>
          <figcaption class="testimonial-card-profile">
            <span class="testimonial-card-meta">
              <strong class="testimonial-card-name"><?php echo esc_html($testimonial['name']); ?></strong>
              <span class="testimonial-card-role"><?php echo esc_html($testimonial['role']); ?></span>
            </span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>