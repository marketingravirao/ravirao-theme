<?php
if (!defined('ABSPATH')) {
    exit;
}

$rrtc_plugin_available = function_exists('my_calendar_get_events') &&
    function_exists('mc_is_remote_db') &&
    function_exists('my_calendar_categories_table');
$rrtc_category_ids = [3, 1, 2];
$rrtc_categories = [];
$rrtc_categories_by_id = [];
$rrtc_events = [];
$rrtc_anchor = isset($args['anchor']) ? sanitize_title($args['anchor']) : 'travel';
$rrtc_page_url = is_post_type_archive('journal')
    ? get_post_type_archive_link('journal')
    : get_permalink(get_queried_object_id());
$rrtc_page_url = $rrtc_page_url ? $rrtc_page_url : home_url('/');
$rrtc_contact_url = is_post_type_archive('journal') ? home_url('/#business-enquiry') : '#business-enquiry';
$rrtc_today = new DateTimeImmutable(current_time('Y-m-d'), wp_timezone());
$rrtc_month_value = isset($_GET['travel_month']) ? wp_unslash($_GET['travel_month']) : null;
$rrtc_year_value = isset($_GET['travel_year']) ? wp_unslash($_GET['travel_year']) : null;
$rrtc_month = is_scalar($rrtc_month_value) ? absint($rrtc_month_value) : (int) $rrtc_today->format('n');
$rrtc_year = is_scalar($rrtc_year_value) ? absint($rrtc_year_value) : (int) $rrtc_today->format('Y');

if ($rrtc_month < 1 || $rrtc_month > 12 || $rrtc_year < 1970 || $rrtc_year > 2100) {
    $rrtc_month = (int) $rrtc_today->format('n');
    $rrtc_year = (int) $rrtc_today->format('Y');
}

$rrtc_month_start = new DateTimeImmutable(sprintf('%04d-%02d-01', $rrtc_year, $rrtc_month), wp_timezone());
$rrtc_month_end = $rrtc_month_start->modify('last day of this month');
$rrtc_category_value = isset($_GET['travel_category']) ? wp_unslash($_GET['travel_category']) : null;
$rrtc_selected_category = is_scalar($rrtc_category_value) ? absint($rrtc_category_value) : 0;

if ($rrtc_plugin_available) {
    $rrtc_db = mc_is_remote_db();
    $rrtc_placeholders = implode(',', array_fill(0, count($rrtc_category_ids), '%d'));
    $rrtc_category_query = $rrtc_db->prepare(
        'SELECT category_id, category_name, category_color FROM ' . my_calendar_categories_table() .
        ' WHERE category_id IN (' . $rrtc_placeholders . ') AND category_private = 0 ORDER BY category_name ASC',
        $rrtc_category_ids
    );
    $rrtc_categories = $rrtc_db->get_results($rrtc_category_query);
    if (!is_array($rrtc_categories)) {
        $rrtc_categories = [];
    }

    foreach ($rrtc_categories as $rrtc_category) {
        $rrtc_category_id = (int) $rrtc_category->category_id;
        $rrtc_category_slug = sanitize_title($rrtc_category->category_name);
        $rrtc_categories_by_id[$rrtc_category_id] = [
            'name' => $rrtc_category->category_name,
            'slug' => $rrtc_category_slug,
            'color' => sanitize_hex_color($rrtc_category->category_color),
        ];
    }

    if (!isset($rrtc_categories_by_id[$rrtc_selected_category])) {
        $rrtc_selected_category = 0;
    }

    $rrtc_category_filter = $rrtc_selected_category
        ? (string) $rrtc_selected_category
        : implode(',', $rrtc_category_ids);
    $rrtc_events = my_calendar_get_events([
        'from' => $rrtc_month_start->format('Y-m-d'),
        'to' => $rrtc_month_end->format('Y-m-d'),
        'category' => $rrtc_category_filter,
        'ltype' => 'all',
        'lvalue' => 'all',
        'author' => 'all',
        'host' => 'all',
        'search' => '',
        'site' => false,
        'holidays' => false,
    ]);
    if (!is_array($rrtc_events)) {
        $rrtc_events = [];
    }

    usort($rrtc_categories, function ($first, $second) {
        $preferred_order = ['abroad' => 0, 'india' => 1, 'hometown' => 2];
        $first_slug = sanitize_title($first->category_name);
        $second_slug = sanitize_title($second->category_name);
        $first_position = isset($preferred_order[$first_slug]) ? $preferred_order[$first_slug] : PHP_INT_MAX;
        $second_position = isset($preferred_order[$second_slug]) ? $preferred_order[$second_slug] : PHP_INT_MAX;
        if ($first_position !== $second_position) {
            return $first_position < $second_position ? -1 : 1;
        }

        return strcasecmp($first->category_name, $second->category_name);
    });
}

$rrtc_calendar_events = [];
foreach ($rrtc_events as $rrtc_event) {
    if (empty($rrtc_event->occur_begin) || empty($rrtc_event->event_title)) {
        continue;
    }

    $rrtc_start_timestamp = strtotime($rrtc_event->occur_begin);
    $rrtc_end_timestamp = strtotime(!empty($rrtc_event->occur_end) ? $rrtc_event->occur_end : $rrtc_event->occur_begin);
    if (!$rrtc_start_timestamp || !$rrtc_end_timestamp) {
        continue;
    }

    $rrtc_start_date = function_exists('mc_date')
        ? mc_date('Y-m-d', $rrtc_start_timestamp, false)
        : wp_date('Y-m-d', $rrtc_start_timestamp);
    $rrtc_end_date = function_exists('mc_date')
        ? mc_date('Y-m-d', $rrtc_end_timestamp, false)
        : wp_date('Y-m-d', $rrtc_end_timestamp);

    $rrtc_category_id = isset($rrtc_event->event_category) ? (int) $rrtc_event->event_category : 0;
    $rrtc_event_category = isset($rrtc_categories_by_id[$rrtc_category_id])
        ? $rrtc_categories_by_id[$rrtc_category_id]
        : ['name' => '', 'slug' => '', 'color' => ''];
    if (!$rrtc_event_category['name'] && !empty($rrtc_event->categories) && is_array($rrtc_event->categories)) {
        $rrtc_event_category_obj = reset($rrtc_event->categories);
        if (is_object($rrtc_event_category_obj)) {
            $rrtc_event_category = [
                'name' => $rrtc_event_category_obj->category_name,
                'slug' => sanitize_title($rrtc_event_category_obj->category_name),
                'color' => sanitize_hex_color($rrtc_event_category_obj->category_color),
            ];
        }
    }

    $rrtc_place = '';
    if (!empty($rrtc_event->location) && is_object($rrtc_event->location)) {
        $rrtc_place = !empty($rrtc_event->location->location_label)
            ? $rrtc_event->location->location_label
            : implode(', ', array_filter([
                isset($rrtc_event->location->location_city) ? $rrtc_event->location->location_city : '',
                isset($rrtc_event->location->location_state) ? $rrtc_event->location->location_state : '',
                isset($rrtc_event->location->location_country) ? $rrtc_event->location->location_country : '',
            ]));
    }

    $rrtc_date_label = wp_date('j M', $rrtc_start_timestamp);
    if ($rrtc_start_date !== $rrtc_end_date) {
        $rrtc_date_label .= ' – ' . wp_date('j M', $rrtc_end_timestamp);
    }

    $rrtc_calendar_events[] = [
        'start' => $rrtc_start_date,
        'end' => $rrtc_end_date,
        'title' => $rrtc_event->event_title,
        'place' => $rrtc_place,
        'category' => $rrtc_event_category,
        'url' => !empty($rrtc_event->event_link) ? $rrtc_event->event_link : '',
        'date_label' => $rrtc_date_label,
        'datetime' => wp_date(DATE_W3C, $rrtc_start_timestamp),
    ];
}

$rrtc_url = function ($month_start, $category_id = 0) use ($rrtc_page_url, $rrtc_anchor) {
    $query = [
        'travel_month' => (int) $month_start->format('n'),
        'travel_year' => (int) $month_start->format('Y'),
    ];
    if ($category_id) {
        $query['travel_category'] = (int) $category_id;
    }

    return esc_url(add_query_arg($query, $rrtc_page_url) . '#' . $rrtc_anchor);
};
?>
<div class="tcal">
  <?php if ($rrtc_plugin_available) : ?>
    <div class="tc-card">
      <div class="tc-bar">
        <h3 class="tc-month" aria-live="polite"><?php echo esc_html(wp_date('F Y', $rrtc_month_start->getTimestamp())); ?></h3>
        <nav class="tc-nav" aria-label="<?php esc_attr_e('Travel calendar month navigation', 'ravirao-theme'); ?>">
          <a href="<?php echo $rrtc_url($rrtc_month_start->modify('-1 month'), $rrtc_selected_category); ?>" aria-label="<?php esc_attr_e('Previous month', 'ravirao-theme'); ?>">‹</a>
          <a href="<?php echo $rrtc_url($rrtc_today->modify('first day of this month'), $rrtc_selected_category); ?>"><?php esc_html_e('Today', 'ravirao-theme'); ?></a>
          <a href="<?php echo $rrtc_url($rrtc_month_start->modify('+1 month'), $rrtc_selected_category); ?>" aria-label="<?php esc_attr_e('Next month', 'ravirao-theme'); ?>">›</a>
        </nav>
      </div>
      <div class="tc-chips" role="group" aria-label="<?php esc_attr_e('Filter events by category', 'ravirao-theme'); ?>">
        <a href="<?php echo $rrtc_url($rrtc_month_start); ?>" <?php echo $rrtc_selected_category ? '' : 'aria-current="true"'; ?>><?php esc_html_e('All categories', 'ravirao-theme'); ?></a>
        <?php foreach ($rrtc_categories as $rrtc_category) :
            $rrtc_category_id = (int) $rrtc_category->category_id;
            $rrtc_category_info = $rrtc_categories_by_id[$rrtc_category_id];
            $rrtc_category_class = 'c-' . $rrtc_category_info['slug'];
            $rrtc_style = $rrtc_category_info['color'] && !in_array($rrtc_category_info['slug'], ['abroad', 'india', 'hometown'], true)
                ? ' style="--tc-category-color: ' . esc_attr($rrtc_category_info['color']) . ';"'
                : '';
        ?>
          <a href="<?php echo $rrtc_url($rrtc_month_start, $rrtc_category_id); ?>" <?php echo $rrtc_selected_category === $rrtc_category_id ? 'aria-current="true"' : ''; ?>><i class="tc-dot <?php echo esc_attr($rrtc_category_class); ?>"<?php echo $rrtc_style; ?>></i><?php echo esc_html($rrtc_category_info['name']); ?></a>
        <?php endforeach; ?>
      </div>
      <div class="tc-wk" aria-hidden="true">
        <span><?php esc_html_e('Sun', 'ravirao-theme'); ?></span><span><?php esc_html_e('Mon', 'ravirao-theme'); ?></span><span><?php esc_html_e('Tue', 'ravirao-theme'); ?></span><span><?php esc_html_e('Wed', 'ravirao-theme'); ?></span><span><?php esc_html_e('Thu', 'ravirao-theme'); ?></span><span><?php esc_html_e('Fri', 'ravirao-theme'); ?></span><span><?php esc_html_e('Sat', 'ravirao-theme'); ?></span>
      </div>
      <div class="tc-grid" role="grid" aria-label="<?php echo esc_attr(wp_date('F Y', $rrtc_month_start->getTimestamp())); ?>">
        <?php for ($rrtc_blank = 0; $rrtc_blank < (int) $rrtc_month_start->format('w'); $rrtc_blank++) : ?>
          <span class="tc-day empty" role="gridcell" aria-hidden="true"></span>
        <?php endfor; ?>
        <?php for ($rrtc_day = 1; $rrtc_day <= (int) $rrtc_month_start->format('t'); $rrtc_day++) :
            $rrtc_date = $rrtc_month_start->modify('+' . ($rrtc_day - 1) . ' days');
            $rrtc_date_key = $rrtc_date->format('Y-m-d');
            $rrtc_day_events = [];
            foreach ($rrtc_calendar_events as $rrtc_calendar_event) {
                if ($rrtc_calendar_event['start'] <= $rrtc_date_key && $rrtc_calendar_event['end'] >= $rrtc_date_key) {
                    $rrtc_day_events[] = $rrtc_calendar_event;
                }
            }
            $rrtc_day_classes = ['tc-day'];
            if ($rrtc_day_events) {
                $rrtc_day_classes[] = 'has';
            }
            if ($rrtc_date_key === $rrtc_today->format('Y-m-d')) {
                $rrtc_day_classes[] = 'today';
            }
            $rrtc_day_titles = wp_list_pluck($rrtc_day_events, 'title');
        ?>
          <span class="<?php echo esc_attr(implode(' ', $rrtc_day_classes)); ?>" role="gridcell" <?php echo $rrtc_date_key === $rrtc_today->format('Y-m-d') ? 'aria-current="date"' : ''; ?><?php echo $rrtc_day_titles ? ' aria-label="' . esc_attr($rrtc_date->format('F j') . ': ' . implode(', ', $rrtc_day_titles)) . '"' : ''; ?>>
            <b><?php echo esc_html($rrtc_day); ?></b>
            <span class="tc-dots">
              <?php foreach (array_slice($rrtc_day_events, 0, 3) as $rrtc_day_event) :
                  $rrtc_dot_class = $rrtc_day_event['category']['slug'] ? 'c-' . $rrtc_day_event['category']['slug'] : '';
                  $rrtc_dot_style = $rrtc_day_event['category']['color'] && !in_array($rrtc_day_event['category']['slug'], ['abroad', 'india', 'hometown'], true)
                      ? ' style="--tc-category-color: ' . esc_attr($rrtc_day_event['category']['color']) . ';"'
                      : '';
              ?>
                <i class="tc-dot <?php echo esc_attr($rrtc_dot_class); ?>"<?php echo $rrtc_dot_style; ?>></i>
              <?php endforeach; ?>
            </span>
          </span>
        <?php endfor; ?>
      </div>
    </div>
    <div class="tc-side">
      <div class="eyebrow"><?php esc_html_e('Schedule', 'ravirao-theme'); ?></div>
      <h3 class="tc-sub serif"><?php echo esc_html(sprintf(__('Events in %s', 'ravirao-theme'), wp_date('F Y', $rrtc_month_start->getTimestamp()))); ?></h3>
      <?php if ($rrtc_calendar_events) : ?>
        <ul class="tc-list">
          <?php foreach ($rrtc_calendar_events as $rrtc_calendar_event) :
              $rrtc_event_category = $rrtc_calendar_event['category'];
              $rrtc_event_class = $rrtc_event_category['slug'] ? 'c-' . $rrtc_event_category['slug'] : '';
              $rrtc_event_style = $rrtc_event_category['color'] && !in_array($rrtc_event_category['slug'], ['abroad', 'india', 'hometown'], true)
                  ? ' style="--tc-category-color: ' . esc_attr($rrtc_event_category['color']) . ';"'
                  : '';
          ?>
            <li class="tc-ev">
              <time datetime="<?php echo esc_attr($rrtc_calendar_event['datetime']); ?>"><?php echo esc_html($rrtc_calendar_event['date_label']); ?></time>
              <div>
                <b>
                  <?php if ($rrtc_calendar_event['url']) : ?>
                    <a href="<?php echo esc_url($rrtc_calendar_event['url']); ?>" rel="noopener noreferrer"><?php echo esc_html($rrtc_calendar_event['title']); ?></a>
                  <?php else : ?>
                    <?php echo esc_html($rrtc_calendar_event['title']); ?>
                  <?php endif; ?>
                </b>
                <?php if ($rrtc_calendar_event['place']) : ?><span><?php echo esc_html($rrtc_calendar_event['place']); ?></span><?php endif; ?>
              </div>
              <?php if ($rrtc_event_category['name']) : ?><em class="<?php echo esc_attr($rrtc_event_class); ?>"<?php echo $rrtc_event_style; ?>><?php echo esc_html($rrtc_event_category['name']); ?></em><?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else : ?>
        <p class="tc-empty show"><?php esc_html_e('No public engagements are listed for this month.', 'ravirao-theme'); ?></p>
      <?php endif; ?>
      <p class="tc-note"><?php esc_html_e('To meet Dr. Ravi Rao during a visit, write to the office.', 'ravirao-theme'); ?> <a href="<?php echo esc_url($rrtc_contact_url); ?>" data-cta="travel_contact"><?php esc_html_e('Write to the office', 'ravirao-theme'); ?> →</a></p>
    </div>
  <?php else : ?>
    <p class="tc-empty show"><?php esc_html_e('The Travel Calendar is temporarily unavailable.', 'ravirao-theme'); ?></p>
  <?php endif; ?>
</div>
