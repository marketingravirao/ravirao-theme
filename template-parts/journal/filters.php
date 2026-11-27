<?php
if (!defined('ABSPATH')) {
    exit;
}

$rrj_filter_mode = isset($args['mode']) ? $args['mode'] : 'journal';
$rrj_filter_action = isset($args['action']) ? $args['action'] : '';
$rrj_filter_search = isset($args['search']) ? $args['search'] : '';
$rrj_filter_type = isset($args['type']) ? $args['type'] : '';
$rrj_filter_topic = isset($args['topic']) ? $args['topic'] : '';
$rrj_filter_types = isset($args['types']) ? $args['types'] : [];
$rrj_filter_topics = isset($args['topics']) ? $args['topics'] : [];
$rrj_filter_show_types = !isset($args['show_types']) || (bool) $args['show_types'];
$rrj_filter_label = isset($args['label']) ? $args['label'] : __('Filter the journal', 'ravirao-theme');
$rrj_search_label = isset($args['search_label']) ? $args['search_label'] : __('Search the journal', 'ravirao-theme');
?>
<section class="rrj-filter" id="<?php echo esc_attr($rrj_filter_mode === 'journal' ? 'journal-search' : 'gallery-search'); ?>" aria-label="<?php echo esc_attr($rrj_filter_label); ?>">
  <form
    class="rr-container rrj-filter__form<?php echo $rrj_filter_show_types ? '' : ' rrj-filter__form--single'; ?>"
    data-rrj-live-filter
    data-rrj-live-mode="<?php echo esc_attr($rrj_filter_mode); ?>"
    data-rrj-loading-text="<?php esc_attr_e('Updating results.', 'ravirao-theme'); ?>"
    data-rrj-result-singular="<?php esc_attr_e('result found.', 'ravirao-theme'); ?>"
    data-rrj-results-plural="<?php esc_attr_e('results found.', 'ravirao-theme'); ?>"
    data-rrj-error-text="<?php echo esc_attr(sprintf(__('%s results could not be updated. Please try again or submit the search.', 'ravirao-theme'), $rrj_filter_mode === 'gallery' ? __('Gallery', 'ravirao-theme') : __('Journal', 'ravirao-theme'))); ?>"
    method="get"
    action="<?php echo esc_url($rrj_filter_action); ?>"
  >
    <div class="rrj-filter__top">
      <?php if ($rrj_filter_show_types) : ?>
      <fieldset class="rrj-filter__group">
        <legend><?php esc_html_e('Type', 'ravirao-theme'); ?></legend>
        <div class="rrj-filter__choices">
          <label class="rrj-filter__chip">
            <input type="radio" name="j_type" value="" <?php checked($rrj_filter_type, ''); ?>>
            <span><?php esc_html_e('All', 'ravirao-theme'); ?></span>
          </label>
          <?php if ($rrj_filter_types && !is_wp_error($rrj_filter_types)) : foreach ($rrj_filter_types as $rrj_term) : ?>
            <label class="rrj-filter__chip">
              <input type="radio" name="j_type" value="<?php echo esc_attr($rrj_term->slug); ?>" <?php checked($rrj_filter_type, $rrj_term->slug); ?>>
              <span><?php echo esc_html(ravirao_journal_filter_type_label($rrj_term)); ?></span>
            </label>
          <?php endforeach; endif; ?>
        </div>
      </fieldset>
      <?php endif; ?>
      <label class="rrj-filter__search">
        <span class="screen-reader-text"><?php echo esc_html($rrj_search_label); ?></span>
        <svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><circle cx="10.8" cy="10.8" r="6.8"></circle><path d="m16 16 5 5"></path></svg>
        <input type="search" name="journal_search" value="<?php echo esc_attr($rrj_filter_search); ?>" placeholder="<?php echo esc_attr($rrj_search_label); ?>" autocomplete="off">
      </label>
    </div>
    <fieldset class="rrj-filter__group rrj-filter__group--topics">
      <legend><?php esc_html_e('Topic', 'ravirao-theme'); ?></legend>
      <div class="rrj-filter__choices">
        <label class="rrj-filter__chip">
          <input type="radio" name="j_topic" value="" <?php checked($rrj_filter_topic, ''); ?>>
          <span><?php esc_html_e('All topics', 'ravirao-theme'); ?></span>
        </label>
        <?php if ($rrj_filter_topics && !is_wp_error($rrj_filter_topics)) : foreach ($rrj_filter_topics as $rrj_term) : ?>
          <label class="rrj-filter__chip">
            <input type="radio" name="j_topic" value="<?php echo esc_attr($rrj_term->slug); ?>" <?php checked($rrj_filter_topic, $rrj_term->slug); ?>>
            <span><?php echo esc_html($rrj_term->name); ?></span>
          </label>
        <?php endforeach; endif; ?>
      </div>
    </fieldset>
    <button class="screen-reader-text" type="submit"><?php esc_html_e('Apply filters', 'ravirao-theme'); ?></button>
    <noscript><button class="rrj-button rrj-button--small" type="submit"><?php esc_html_e('Apply filters', 'ravirao-theme'); ?></button></noscript>
    <p class="rrj-filter__status screen-reader-text" data-rrj-filter-status role="status" aria-live="polite" aria-atomic="true"></p>
  </form>
</section>
