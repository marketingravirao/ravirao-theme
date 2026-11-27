<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('ravirao_journal_get_field_value')) {
    function ravirao_journal_get_field_value($field_name, $post_id, $legacy_meta_key = '') {
        $value = function_exists('get_field')
            ? get_field($field_name, $post_id)
            : get_post_meta($post_id, $field_name, true);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }

        return $legacy_meta_key ? get_post_meta($post_id, $legacy_meta_key, true) : $value;
    }
}

if (!function_exists('ravirao_journal_order_filter_terms')) {
    function ravirao_journal_order_filter_terms($terms, $preferred_order) {
        if (!is_array($terms)) {
            return $terms;
        }

        $positions = array_flip($preferred_order);
        usort($terms, function ($first, $second) use ($positions) {
            $first_position = isset($positions[$first->slug]) ? $positions[$first->slug] : PHP_INT_MAX;
            $second_position = isset($positions[$second->slug]) ? $positions[$second->slug] : PHP_INT_MAX;
            if ($first_position !== $second_position) {
                return $first_position < $second_position ? -1 : 1;
            }

            return strcasecmp($first->name, $second->name);
        });

        return $terms;
    }
}

if (!function_exists('ravirao_journal_filter_type_label')) {
    function ravirao_journal_filter_type_label($term) {
        $labels = [
            'article' => __('Articles', 'ravirao-theme'),
            'news' => __('News', 'ravirao-theme'),
            'press' => __('Press and interviews', 'ravirao-theme'),
            'video' => __('Videos', 'ravirao-theme'),
            'photo-album' => __('Photo albums', 'ravirao-theme'),
        ];

        return isset($labels[$term->slug]) ? $labels[$term->slug] : $term->name;
    }
}

if (!function_exists('ravirao_journal_type_slug')) {
    function ravirao_journal_type_slug($post_id) {
        $terms = get_the_terms($post_id, 'journal_type');
        return $terms && !is_wp_error($terms) ? $terms[0]->slug : '';
    }
}

if (!function_exists('ravirao_journal_type_label')) {
    function ravirao_journal_type_label($post_id) {
        $terms = get_the_terms($post_id, 'journal_type');
        return $terms && !is_wp_error($terms) ? $terms[0]->name : '';
    }
}

if (!function_exists('ravirao_journal_topics')) {
    function ravirao_journal_topics($post_id) {
        $terms = get_the_terms($post_id, 'journal_topic');
        if (!$terms || is_wp_error($terms)) {
            return '';
        }

        return implode(' · ', wp_list_pluck($terms, 'name'));
    }
}

if (!function_exists('ravirao_journal_get_video_embed')) {
    function ravirao_journal_get_video_embed($url) {
        $url = trim((string) $url);
        if (preg_match('~(?:youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $url, $matches)) {
            return 'https://www.youtube-nocookie.com/embed/' . rawurlencode($matches[1]);
        }

        if (preg_match('~(?:vimeo\.com/(?:video/)?)(\d+)~', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . rawurlencode($matches[1]);
        }

        return '';
    }
}
