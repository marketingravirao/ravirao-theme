<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once get_theme_file_path('/template-parts/journal/helpers.php');

$rrj_search = isset($_GET['journal_search']) ? sanitize_text_field(wp_unslash($_GET['journal_search'])) : '';
$rrj_type = isset($_GET['j_type']) ? sanitize_title(wp_unslash($_GET['j_type'])) : '';
$rrj_topic = isset($_GET['j_topic']) ? sanitize_title(wp_unslash($_GET['j_topic'])) : '';
$rrj_invalid_filters = ($rrj_type && !term_exists($rrj_type, 'journal_type')) ||
    ($rrj_topic && !term_exists($rrj_topic, 'journal_topic'));
$rrj_gallery_ids = get_posts([
    'post_type' => 'gallery',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids',
]);
$rrj_gallery_types = $rrj_gallery_ids ? ravirao_journal_order_filter_terms(get_terms(['taxonomy' => 'journal_type', 'hide_empty' => false, 'object_ids' => $rrj_gallery_ids]), ['article', 'news', 'press', 'video', 'photo-album']) : [];
$rrj_gallery_topics = $rrj_gallery_ids ? ravirao_journal_order_filter_terms(get_terms(['taxonomy' => 'journal_topic', 'hide_empty' => false, 'object_ids' => $rrj_gallery_ids]), ['vaastu', 'jyotish', 'events']) : [];
$rrj_tax_query = ['relation' => 'AND'];
if ($rrj_type && !$rrj_invalid_filters) {
    $rrj_tax_query[] = ['taxonomy' => 'journal_type', 'field' => 'slug', 'terms' => $rrj_type];
}
if ($rrj_topic && !$rrj_invalid_filters) {
    $rrj_tax_query[] = ['taxonomy' => 'journal_topic', 'field' => 'slug', 'terms' => $rrj_topic];
}

$rrj_gallery = new WP_Query([
    'post_type' => 'gallery',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'paged' => max(1, (int) get_query_var('paged')),
    's' => $rrj_search,
    'tax_query' => count($rrj_tax_query) > 1 ? $rrj_tax_query : [],
    'post__in' => $rrj_invalid_filters ? [0] : [],
    'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
]);

get_header();
?>
<main class="rr-journal rrj-gallery-archive">
  <section class="rrj-hero rrj-hero--compact" aria-labelledby="rrj-gallery-title">
    <div class="rr-container rrj-hero__inner">
      <div class="rrj-hero__copy">
        <p class="rrj-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ravirao-theme'); ?></a><span aria-hidden="true">/</span><a href="<?php echo esc_url(get_post_type_archive_link('journal')); ?>"><?php esc_html_e('Journal', 'ravirao-theme'); ?></a><span aria-hidden="true">/</span><strong><?php esc_html_e('Gallery', 'ravirao-theme'); ?></strong></p>
        <p class="rrj-eyebrow"><?php esc_html_e('Photo albums · Videos', 'ravirao-theme'); ?></p>
        <h1 id="rrj-gallery-title"><?php esc_html_e('The journey in', 'ravirao-theme'); ?> <em><?php esc_html_e('pictures and film', 'ravirao-theme'); ?></em></h1>
      </div>
    </div>
  </section>
  <?php
  get_template_part('template-parts/journal/filters', null, [
      'mode' => 'gallery',
      'action' => get_post_type_archive_link('gallery'),
      'search' => $rrj_search,
      'type' => $rrj_type,
      'topic' => $rrj_topic,
      'types' => $rrj_gallery_types,
      'topics' => $rrj_gallery_topics,
      'label' => __('Filter the Gallery', 'ravirao-theme'),
      'search_label' => __('Search the Gallery', 'ravirao-theme'),
  ]);
  ?>
  <div id="rrj-live-results">
  <section class="rrj-section rrj-results" id="results" data-result-count="<?php echo esc_attr($rrj_gallery->found_posts); ?>">
    <div class="rr-container">
      <div class="rrj-section-heading"><div><p class="rrj-eyebrow"><?php esc_html_e('Gallery', 'ravirao-theme'); ?></p><h2><?php esc_html_e('Albums and videos', 'ravirao-theme'); ?></h2></div><p><?php echo esc_html(sprintf(_n('%s item', '%s items', (int) $rrj_gallery->found_posts, 'ravirao-theme'), number_format_i18n($rrj_gallery->found_posts))); ?></p></div>
      <?php if ($rrj_gallery->have_posts()) : ?>
        <div class="rrj-results__grid">
          <?php while ($rrj_gallery->have_posts()) : $rrj_gallery->the_post(); get_template_part('template-parts/journal/card', null, ['variant' => 'result']); endwhile; ?>
        </div>
        <?php
        $rrj_links = paginate_links([
            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'current' => max(1, (int) get_query_var('paged')),
            'total' => (int) $rrj_gallery->max_num_pages,
            'add_args' => array_filter(
                ['journal_search' => $rrj_search, 'j_type' => $rrj_type, 'j_topic' => $rrj_topic],
                function ($value) {
                    return $value !== '';
                }
            ),
            'prev_text' => __('Previous', 'ravirao-theme'),
            'next_text' => __('Next', 'ravirao-theme'),
            'type' => 'list',
        ]);
        if ($rrj_links) :
        ?>
          <nav class="rrj-pagination" aria-label="<?php esc_attr_e('Gallery pages', 'ravirao-theme'); ?>"><?php echo wp_kses_post($rrj_links); ?></nav>
        <?php endif; ?>
      <?php else : ?>
        <div class="rrj-empty"><h2><?php esc_html_e('No Gallery items found', 'ravirao-theme'); ?></h2><p><?php esc_html_e('Try a different search or add albums and videos from the WordPress admin.', 'ravirao-theme'); ?></p></div>
      <?php endif; ?>
    </div>
  </section>
  </div>
</main>
<?php
wp_reset_postdata();
get_footer();
