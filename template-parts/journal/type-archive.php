<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once get_theme_file_path('/template-parts/journal/helpers.php');

$rrj_type_term = get_queried_object();
if (!($rrj_type_term instanceof WP_Term) || $rrj_type_term->taxonomy !== 'journal_type') {
    wp_die(esc_html__('The requested journal type could not be found.', 'ravirao-theme'));
}

$rrj_type_url = get_term_link($rrj_type_term);
if (is_wp_error($rrj_type_url)) {
    wp_die(esc_html($rrj_type_url->get_error_message()));
}

$rrj_type_label = ravirao_journal_filter_type_label($rrj_type_term);
$rrj_archive_url = get_post_type_archive_link('journal');
$rrj_search = isset($_GET['journal_search']) ? sanitize_text_field(wp_unslash($_GET['journal_search'])) : '';
$rrj_topic = isset($_GET['j_topic']) ? sanitize_title(wp_unslash($_GET['j_topic'])) : '';
$rrj_topic_term = $rrj_topic ? get_term_by('slug', $rrj_topic, 'journal_topic') : null;
$rrj_invalid_topic = $rrj_topic && !$rrj_topic_term;
$rrj_topics = ravirao_journal_order_filter_terms(
    get_terms(['taxonomy' => 'journal_topic', 'hide_empty' => true]),
    ['vaastu', 'jyotish', 'events', 'temple-vaastu', 'industrial-vaastu']
);
$rrj_tax_query = [
    'relation' => 'AND',
    [
        'taxonomy' => 'journal_type',
        'field' => 'term_id',
        'terms' => (int) $rrj_type_term->term_id,
    ],
];

if ($rrj_topic && !$rrj_invalid_topic) {
    $rrj_tax_query[] = [
        'taxonomy' => 'journal_topic',
        'field' => 'term_id',
        'terms' => (int) $rrj_topic_term->term_id,
    ];
}

$rrj_type_query = new WP_Query([
    'post_type' => ['journal', 'gallery'],
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'paged' => max(1, (int) get_query_var('paged')),
    's' => $rrj_search,
    'tax_query' => $rrj_tax_query,
    'post__in' => $rrj_invalid_topic ? [0] : [],
    'orderby' => ['date' => 'DESC'],
]);

?>
<main class="rr-journal rrj-type-archive">
  <section class="rrj-hero" aria-labelledby="rrj-type-title">
    <div class="rrj-hero__inner rr-container">
      <div class="rrj-hero__copy">
        <p class="rrj-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ravirao-theme'); ?></a><span aria-hidden="true">/</span><a href="<?php echo esc_url($rrj_archive_url); ?>"><?php esc_html_e('Journal', 'ravirao-theme'); ?></a><span aria-hidden="true">/</span><strong><?php echo esc_html($rrj_type_label); ?></strong></p>
        <p class="rrj-eyebrow"><span aria-hidden="true"></span><?php esc_html_e('Journal archive', 'ravirao-theme'); ?></p>
        <h1 id="rrj-type-title"><?php esc_html_e('Explore', 'ravirao-theme'); ?> <em><?php echo esc_html($rrj_type_label); ?></em></h1>
        <div class="rrj-hero__actions">
          <a class="rrj-button" href="<?php echo esc_url($rrj_archive_url); ?>"><?php esc_html_e('Back to the Journal', 'ravirao-theme'); ?></a>
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

  <?php
  get_template_part('template-parts/journal/filters', null, [
      'mode' => 'journal',
      'action' => $rrj_type_url,
      'search' => $rrj_search,
      'topic' => $rrj_topic,
      'topics' => $rrj_topics,
      'show_types' => false,
      'label' => sprintf(__('Filter %s', 'ravirao-theme'), $rrj_type_label),
      'search_label' => sprintf(__('Search %s', 'ravirao-theme'), $rrj_type_label),
  ]);
  ?>

  <div id="rrj-live-results">
    <section class="rrj-section rrj-results" data-result-count="<?php echo esc_attr($rrj_type_query->found_posts); ?>" aria-labelledby="rrj-type-results-title">
      <div class="rr-container">
        <div class="rrj-section-heading">
          <div>
            <p class="rrj-eyebrow"><?php echo esc_html($rrj_type_label); ?></p>
            <h2 id="rrj-type-results-title"><?php echo esc_html(sprintf(__('All %s', 'ravirao-theme'), $rrj_type_label)); ?></h2>
          </div>
          <p><?php echo esc_html(sprintf(_n('%s item', '%s items', (int) $rrj_type_query->found_posts, 'ravirao-theme'), number_format_i18n($rrj_type_query->found_posts))); ?></p>
        </div>

        <?php if ($rrj_type_query->have_posts()) : ?>
          <div class="rrj-results__grid">
            <?php while ($rrj_type_query->have_posts()) : $rrj_type_query->the_post(); ?>
              <?php get_template_part('template-parts/journal/card', null, ['variant' => 'result']); ?>
            <?php endwhile; ?>
          </div>
          <?php
          $rrj_links = paginate_links([
              'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
              'current' => max(1, (int) get_query_var('paged')),
              'total' => (int) $rrj_type_query->max_num_pages,
              'add_args' => array_filter([
                  'journal_search' => $rrj_search,
                  'j_topic' => $rrj_topic,
              ], function ($value) {
                  return $value !== '';
              }),
              'prev_text' => __('Previous', 'ravirao-theme'),
              'next_text' => __('Next', 'ravirao-theme'),
              'type' => 'list',
          ]);
          if ($rrj_links) :
          ?>
            <nav class="rrj-pagination" aria-label="<?php esc_attr_e('Journal type pages', 'ravirao-theme'); ?>"><?php echo wp_kses_post($rrj_links); ?></nav>
          <?php endif; ?>
        <?php else : ?>
          <div class="rrj-empty">
            <h3><?php esc_html_e('No matching entries found', 'ravirao-theme'); ?></h3>
            <p><?php esc_html_e('Try another search or topic.', 'ravirao-theme'); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </section>
  </div>
</main>
<?php
wp_reset_postdata();
