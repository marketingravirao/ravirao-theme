<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once get_theme_file_path('/template-parts/journal/helpers.php');

$rrj_archive_url = get_post_type_archive_link('journal');
$rrj_article_url = get_term_link('article', 'journal_type');
$rrj_news_url = get_term_link('news', 'journal_type');
$rrj_press_url = get_term_link('press', 'journal_type');
$rrj_photo_album_url = get_term_link('photo-album', 'journal_type');
$rrj_video_type_url = get_term_link('video', 'journal_type');
$rrj_article_url = is_wp_error($rrj_article_url) ? add_query_arg('j_type', 'article', $rrj_archive_url) : $rrj_article_url;
$rrj_news_url = is_wp_error($rrj_news_url) ? add_query_arg('j_type', 'news', $rrj_archive_url) : $rrj_news_url;
$rrj_press_url = is_wp_error($rrj_press_url) ? add_query_arg('j_type', 'press', $rrj_archive_url) : $rrj_press_url;
$rrj_photo_album_url = is_wp_error($rrj_photo_album_url) ? get_post_type_archive_link('gallery') : $rrj_photo_album_url;
$rrj_video_type_url = is_wp_error($rrj_video_type_url) ? get_post_type_archive_link('gallery') : $rrj_video_type_url;
$rrj_search = isset($_GET['journal_search']) ? sanitize_text_field(wp_unslash($_GET['journal_search'])) : '';
$rrj_type = isset($_GET['j_type']) ? sanitize_title(wp_unslash($_GET['j_type'])) : '';
$rrj_topic = isset($_GET['j_topic']) ? sanitize_title(wp_unslash($_GET['j_topic'])) : '';
$rrj_filtered = $rrj_search !== '' || $rrj_type !== '' || $rrj_topic !== '';
$rrj_invalid_filters = ($rrj_type && !term_exists($rrj_type, 'journal_type')) ||
    ($rrj_topic && !term_exists($rrj_topic, 'journal_topic'));
$rrj_types = ravirao_journal_order_filter_terms(
    get_terms(['taxonomy' => 'journal_type', 'hide_empty' => false]),
    ['article', 'news', 'press', 'video', 'photo-album']
);
$rrj_topics = ravirao_journal_order_filter_terms(
    get_terms(['taxonomy' => 'journal_topic', 'hide_empty' => false]),
    ['vaastu', 'jyotish', 'events']
);
$rrj_page = max(1, (int) get_query_var('paged'));

$rrj_filtered_query = null;
if ($rrj_filtered) {
    $rrj_tax_query = ['relation' => 'AND'];
    if ($rrj_type && !$rrj_invalid_filters) {
        $rrj_tax_query[] = [
            'taxonomy' => 'journal_type',
            'field' => 'slug',
            'terms' => $rrj_type,
        ];
    }
    if ($rrj_topic && !$rrj_invalid_filters) {
        $rrj_tax_query[] = [
            'taxonomy' => 'journal_topic',
            'field' => 'slug',
            'terms' => $rrj_topic,
        ];
    }

    $rrj_filtered_query = new WP_Query([
        'post_type' => ['journal', 'gallery'],
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => $rrj_page,
        's' => $rrj_search,
        'tax_query' => count($rrj_tax_query) > 1 ? $rrj_tax_query : [],
        'post__in' => $rrj_invalid_filters ? [0] : [],
        'orderby' => ['date' => 'DESC'],
    ]);
}

$rrj_query_type = static function ($type, $limit, $exclude = [], $featured_first = false) {
    $args = [
        'post_type' => 'journal',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'tax_query' => [[
            'taxonomy' => 'journal_type',
            'field' => 'slug',
            'terms' => $type,
        ]],
        'post__not_in' => $exclude,
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    if ($featured_first) {
        $args['meta_query'] = [
            'relation' => 'OR',
            [
                'key' => 'journal_featured',
                'value' => '1',
            ],
            [
                'key' => '_ravirao_journal_featured',
                'value' => '1',
            ],
        ];
    }

    return new WP_Query($args);
};

$rrj_featured_query = $rrj_query_type('article', 1, [], true);
if (!$rrj_featured_query->have_posts()) {
    wp_reset_postdata();
    $rrj_featured_query = $rrj_query_type('article', 1);
}
$rrj_featured_id = $rrj_featured_query->have_posts() ? (int) $rrj_featured_query->posts[0]->ID : 0;
$rrj_articles_query = $rrj_query_type('article', 3, $rrj_featured_id ? [$rrj_featured_id] : []);
$rrj_news_query = $rrj_query_type('news', 1);
$rrj_gallery_query = new WP_Query([
    'post_type' => 'gallery',
    'post_status' => 'publish',
    'posts_per_page' => 9,
    'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
]);
$rrj_press_query = $rrj_query_type('press', 3);

?>
<main class="rr-journal">
  <section class="rrj-hero" aria-labelledby="rrj-title">
    <div class="rrj-hero__inner rr-container">
      <div class="rrj-hero__copy">
        <p class="rrj-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ravirao-theme'); ?></a><span aria-hidden="true">/</span><strong><?php esc_html_e('Journal', 'ravirao-theme'); ?></strong></p>
        <p class="rrj-eyebrow"><span aria-hidden="true"></span><?php esc_html_e('Articles · News · Gallery · Press', 'ravirao-theme'); ?></p>
        <h1 id="rrj-title"><?php esc_html_e('Astro-Vaastu Research Centre’s', 'ravirao-theme'); ?> <em><?php esc_html_e('Journal', 'ravirao-theme'); ?></em></h1>
        <div class="rrj-hero__actions">
          <?php if ($rrj_filtered) : ?>
            <a class="rrj-button" href="#results"><?php esc_html_e('View search results', 'ravirao-theme'); ?></a>
          <?php elseif ($rrj_featured_id) : ?>
            <a class="rrj-button" href="#featured"><?php esc_html_e('Read the featured article', 'ravirao-theme'); ?></a>
          <?php else : ?>
            <a class="rrj-button" href="#journal-search"><?php esc_html_e('Browse the Journal', 'ravirao-theme'); ?></a>
          <?php endif; ?>
          <?php if (!$rrj_filtered && $rrj_gallery_query->have_posts()) : ?>
            <a class="rrj-text-link" href="<?php echo esc_url(get_post_type_archive_link('gallery')); ?>"><?php esc_html_e('Explore the Gallery', 'ravirao-theme'); ?></a>
          <?php endif; ?>
        </div>
      </div>
      <div class="rrj-hero__art" aria-hidden="true">
        <img
          class="rrj-hero__lotus"
          src="<?php echo esc_url(get_theme_file_uri('/assets/images/journal/journal-hero-lotus.svg')); ?>"
          alt=""
          width="560"
          height="448"
          decoding="async"
        >
      </div>
    </div>
  </section>

  <?php if (!$rrj_filtered) : ?>
    <nav class="rrj-nav" aria-label="<?php esc_attr_e('Journal sections', 'ravirao-theme'); ?>">
      <div class="rr-container">
        <?php if ($rrj_featured_id) : ?><a href="#featured"><b>01</b><?php esc_html_e('Featured article', 'ravirao-theme'); ?></a><?php endif; ?>
        <?php if ($rrj_articles_query->have_posts() || $rrj_news_query->have_posts()) : ?><a href="#articles"><b>02</b><?php esc_html_e('Articles and news', 'ravirao-theme'); ?></a><?php endif; ?>
        <?php if ($rrj_gallery_query->have_posts()) : ?><a href="#gallery"><b>03</b><?php esc_html_e('Gallery', 'ravirao-theme'); ?></a><?php endif; ?>
        <?php if ($rrj_press_query->have_posts()) : ?><a href="#press"><b>04</b><?php esc_html_e('Press and interviews', 'ravirao-theme'); ?></a><?php endif; ?>
        <a href="#calendars"><b>05</b><?php esc_html_e('Calendars', 'ravirao-theme'); ?></a>
        <a href="#business-enquiry"><b>06</b><?php esc_html_e('Consultation', 'ravirao-theme'); ?></a>
      </div>
    </nav>
  <?php endif; ?>

  <?php
  get_template_part('template-parts/journal/filters', null, [
      'mode' => 'journal',
      'action' => $rrj_archive_url,
      'search' => $rrj_search,
      'type' => $rrj_type,
      'topic' => $rrj_topic,
      'types' => $rrj_types,
      'topics' => $rrj_topics,
      'label' => __('Filter the journal', 'ravirao-theme'),
      'search_label' => __('Search the journal', 'ravirao-theme'),
  ]);
  ?>

  <div id="rrj-live-results"<?php echo $rrj_filtered ? '' : ' hidden'; ?>>
    <?php if ($rrj_filtered) : ?>
    <section class="rrj-section rrj-results" id="results" data-result-count="<?php echo esc_attr($rrj_filtered_query->found_posts); ?>" aria-labelledby="rrj-results-title">
      <div class="rr-container">
        <div class="rrj-section-heading">
          <div>
            <p class="rrj-eyebrow"><?php esc_html_e('Journal search', 'ravirao-theme'); ?></p>
            <h2 id="rrj-results-title"><?php esc_html_e('Search results', 'ravirao-theme'); ?></h2>
          </div>
          <p><?php echo esc_html(sprintf(_n('%s result', '%s results', (int) $rrj_filtered_query->found_posts, 'ravirao-theme'), number_format_i18n($rrj_filtered_query->found_posts))); ?></p>
        </div>
        <?php if ($rrj_filtered_query->have_posts()) : ?>
          <div class="rrj-results__grid">
            <?php while ($rrj_filtered_query->have_posts()) : $rrj_filtered_query->the_post(); ?>
              <?php get_template_part('template-parts/journal/card', null, ['variant' => 'result']); ?>
            <?php endwhile; ?>
          </div>
          <?php
          $rrj_page_links = paginate_links([
              'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
              'current' => $rrj_page,
              'total' => (int) $rrj_filtered_query->max_num_pages,
              'add_args' => array_filter([
                  'journal_search' => $rrj_search,
                  'j_type' => $rrj_type,
                  'j_topic' => $rrj_topic,
              ], function ($value) {
                  return $value !== '';
              }),
              'prev_text' => __('Previous', 'ravirao-theme'),
              'next_text' => __('Next', 'ravirao-theme'),
              'type' => 'list',
          ]);
          if ($rrj_page_links) :
          ?>
            <nav class="rrj-pagination" aria-label="<?php esc_attr_e('Search results pages', 'ravirao-theme'); ?>"><?php echo wp_kses_post($rrj_page_links); ?></nav>
          <?php endif; ?>
        <?php else : ?>
          <div class="rrj-empty">
            <h3><?php esc_html_e('No matching journal items', 'ravirao-theme'); ?></h3>
            <p><?php esc_html_e('Try a different search term, type, or topic.', 'ravirao-theme'); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>
  </div>

  <div id="rrj-landing-content"<?php echo $rrj_filtered ? ' hidden' : ''; ?>>
    <?php if (!$rrj_filtered) : ?>

    <?php if ($rrj_featured_id) : ?>
      <?php $rrj_featured_query->the_post(); ?>
      <section class="rrj-section rrj-featured" id="featured" aria-labelledby="rrj-featured-title">
        <div class="rr-container">
          <p class="rrj-eyebrow"><?php esc_html_e('01 / Featured article', 'ravirao-theme'); ?></p>
          <article class="rrj-featured__layout">
            <a class="rrj-featured__image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(sprintf(__('Read %s', 'ravirao-theme'), get_the_title())); ?>">
              <?php if (has_post_thumbnail()) : the_post_thumbnail('large', ['loading' => 'eager', 'fetchpriority' => 'high']); endif; ?>
            </a>
            <div class="rrj-featured__card">
              <p class="rrj-meta"><span class="rrj-tag"><?php echo esc_html(ravirao_journal_type_label(get_the_ID())); ?></span><span><?php echo esc_html(ravirao_journal_topics(get_the_ID())); ?></span><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></p>
              <h2 id="rrj-featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <p class="rrj-featured__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
              <p class="rrj-featured__author"><?php echo esc_html(sprintf(__('By %s', 'ravirao-theme'), get_the_author())); ?></p>
              <a class="rrj-text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read the article', 'ravirao-theme'); ?> <span aria-hidden="true">→</span></a>
            </div>
          </article>
        </div>
      </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php if ($rrj_articles_query->have_posts() || $rrj_news_query->have_posts()) : ?>
      <section class="rrj-section rrj-articles" id="articles" aria-labelledby="rrj-articles-title">
        <div class="rr-container">
          <div class="rrj-section-heading">
            <div><p class="rrj-eyebrow"><?php esc_html_e('02 / Articles and news', 'ravirao-theme'); ?></p><h2 id="rrj-articles-title"><?php esc_html_e('Insights and', 'ravirao-theme'); ?> <em><?php esc_html_e('updates', 'ravirao-theme'); ?></em></h2></div>
            <a class="rrj-text-link" href="<?php echo esc_url($rrj_article_url); ?>"><?php esc_html_e('All articles', 'ravirao-theme'); ?> →</a>
          </div>
          <div class="rrj-articles__layout">
            <div class="rrj-article-list">
              <?php while ($rrj_articles_query->have_posts()) : $rrj_articles_query->the_post(); ?>
                <?php get_template_part('template-parts/journal/card', null, ['variant' => 'row']); ?>
              <?php endwhile; ?>
            </div>
            <?php if ($rrj_news_query->have_posts()) : $rrj_news_query->the_post(); ?>
              <?php
              $rrj_news_url = ravirao_journal_get_field_value('journal_external_url', get_the_ID(), '_ravirao_journal_external_url');
              $rrj_news_url = $rrj_news_url ?: get_permalink();
              $rrj_news_target = $rrj_news_url !== get_permalink() ? ' target="_blank" rel="noopener noreferrer"' : '';
              ?>
              <aside class="rrj-news">
                <p class="rrj-eyebrow"><?php esc_html_e('Latest news', 'ravirao-theme'); ?></p>
                <a class="rrj-news__item" href="<?php echo esc_url($rrj_news_url); ?>"<?php echo $rrj_news_target; ?>>
                  <span class="rrj-tag"><?php echo esc_html(ravirao_journal_type_label(get_the_ID())); ?></span>
                  <h3><?php the_title(); ?></h3>
                  <?php if (has_post_thumbnail()) : ?><span class="rrj-news__image"><?php the_post_thumbnail('medium', ['loading' => 'lazy']); ?></span><?php endif; ?>
                  <span class="rrj-news__excerpt"><?php echo esc_html(get_the_excerpt()); ?></span>
                  <span class="rrj-news__link"><?php esc_html_e('Read the update', 'ravirao-theme'); ?> ↗</span>
                </a>
                <a class="rrj-text-link" href="<?php echo esc_url($rrj_news_url); ?>"><?php esc_html_e('All news', 'ravirao-theme'); ?> →</a>
              </aside>
            <?php endif; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php if ($rrj_gallery_query->have_posts()) : ?>
      <section class="rrj-section rrj-gallery" id="gallery" aria-labelledby="rrj-gallery-title">
        <div class="rr-container">
          <div class="rrj-section-heading">
            <div><p class="rrj-eyebrow"><?php esc_html_e('03 / Gallery', 'ravirao-theme'); ?></p><h2 id="rrj-gallery-title"><?php esc_html_e('The journey in', 'ravirao-theme'); ?> <em><?php esc_html_e('pictures and film', 'ravirao-theme'); ?></em></h2><p><?php esc_html_e('Photo albums and videos gathered over the years.', 'ravirao-theme'); ?></p></div>
            <div class="rrj-type-links">
              <a class="rrj-text-link rrj-text-link--light" href="<?php echo esc_url(get_post_type_archive_link('gallery')); ?>"><?php esc_html_e('Explore the Gallery', 'ravirao-theme'); ?> →</a>
            </div>
          </div>
          <div class="rrj-gallery__grid">
            <?php while ($rrj_gallery_query->have_posts()) : $rrj_gallery_query->the_post(); ?>
              <?php get_template_part('template-parts/journal/card', null, ['variant' => 'gallery']); ?>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php if ($rrj_press_query->have_posts()) : ?>
      <section class="rrj-section rrj-press" id="press" aria-labelledby="rrj-press-title">
        <div class="rr-container">
          <div class="rrj-section-heading">
            <div><p class="rrj-eyebrow"><?php esc_html_e('04 / Press and interviews', 'ravirao-theme'); ?></p><h2 id="rrj-press-title"><?php esc_html_e('Conversations and', 'ravirao-theme'); ?> <em><?php esc_html_e('perspectives', 'ravirao-theme'); ?></em></h2></div>
            <a class="rrj-text-link" href="<?php echo esc_url($rrj_press_url); ?>"><?php esc_html_e('All press features', 'ravirao-theme'); ?> →</a>
          </div>
          <div class="rrj-press__grid">
            <?php while ($rrj_press_query->have_posts()) : $rrj_press_query->the_post(); ?>
              <?php get_template_part('template-parts/journal/card', null, ['variant' => 'press']); ?>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <section class="rrj-section rrj-calendars" id="calendars" aria-labelledby="rrj-calendar-title">
      <div class="rr-container">
        <div class="rrj-section-heading">
          <div><p class="rrj-eyebrow"><?php esc_html_e('05 / Calendars', 'ravirao-theme'); ?></p><h2 id="rrj-calendar-title"><?php esc_html_e('Dates and', 'ravirao-theme'); ?> <em><?php esc_html_e('journeys', 'ravirao-theme'); ?></em></h2></div>
        </div>
        <div class="rrj-calendar-grid">
          <a class="rrj-calendar-card" href="<?php echo esc_url(home_url('/muhurat/')); ?>">
              <span class="rrj-calendar-card__image"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/journal/gal-homa.jpg')); ?>" alt="" loading="lazy"></span>
            <span class="rrj-calendar-card__body"><strong><?php esc_html_e('Muhurat Calendar', 'ravirao-theme'); ?></strong><span><?php esc_html_e('Auspicious dates and timings for important beginnings, from foundation laying to new ventures.', 'ravirao-theme'); ?></span><b><?php esc_html_e('View the full calendar', 'ravirao-theme'); ?> →</b></span>
          </a>
          <?php get_template_part('template-parts/travel-calendar', null, ['anchor' => 'calendars']); ?>
        </div>
      </div>
    </section>
    <?php endif; ?>
  </div>
</main>
<?php
wp_reset_postdata();
