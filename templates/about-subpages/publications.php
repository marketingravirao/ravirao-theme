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
        'url' => home_url('/from-soil-to-soul-the-untold-power-of-bhoomi-poojan-in-vastu-shastra/'),
    ],
    [
        'date' => 'July 2, 2024',
        'title' => 'Not Your Home? Not a Problem: Vastu Hacks for Rented Spaces That Actually Work',
        'description' => 'Practical and effective Vastu tips for tenants—bring harmony and success even when you cannot renovate your space completely.',
        'url' => home_url('/not-your-home-not-a-problem-vastu-hacks-for-rented-spaces-that-actually-work/'),
    ],
    [
        'date' => 'July 1, 2024',
        'title' => 'Hidden Wealth: How Vastu-Compliant Storage Can Boost Factory Output and Harmony',
        'description' => 'Unlock the secrets of storage placement as per Vastu—improve productivity, cash flow, and relationships at your workplace or factory.',
        'url' => home_url('/hidden-wealth-how-vastu-compliant-storage-can-boost-factory-output-and-harmony/'),
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
      <a class="rr-button vaastu-blogs-more-btn" href="<?php echo esc_url(home_url('/category/vaastu/')); ?>" target="_blank" rel="noopener noreferrer">Explore More Vaastu Blogs</a>
    </div>
  </section>

  <?php
  get_template_part('template-parts/sections/trusted-brands', null, [
      'id' => 'rr-publications-clients-title',
      'reveal_heading' => true,
  ]);
  get_template_part('template-parts/sections/industry-testimonials', null, [
      'id' => 'rr-publications-testimonials-title',
      'reveal_heading' => true,
  ]);
  ?>
</main>
<?php get_footer(); ?>