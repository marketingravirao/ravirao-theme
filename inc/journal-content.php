<?php
if (!defined('ABSPATH')) {
    exit;
}

function ravirao_journal_register_content_types() {
    register_post_type('journal', [
        'labels' => [
            'name' => __('Journal', 'ravirao-journal-content'),
            'singular_name' => __('Journal Entry', 'ravirao-journal-content'),
            'add_new_item' => __('Add Journal Entry', 'ravirao-journal-content'),
            'edit_item' => __('Edit Journal Entry', 'ravirao-journal-content'),
            'view_item' => __('View Journal Entry', 'ravirao-journal-content'),
            'search_items' => __('Search Journal', 'ravirao-journal-content'),
            'not_found' => __('No journal entries found.', 'ravirao-journal-content'),
            'all_items' => __('All Journal Entries', 'ravirao-journal-content'),
            'menu_name' => __('Journal', 'ravirao-journal-content'),
        ],
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'journal', 'with_front' => false],
        'menu_icon' => 'dashicons-book-alt',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions', 'page-attributes', 'custom-fields'],
    ]);

    register_post_type('gallery', [
        'labels' => [
            'name' => __('Gallery', 'ravirao-journal-content'),
            'singular_name' => __('Gallery Item', 'ravirao-journal-content'),
            'add_new_item' => __('Add Gallery Item', 'ravirao-journal-content'),
            'edit_item' => __('Edit Gallery Item', 'ravirao-journal-content'),
            'view_item' => __('View Gallery Item', 'ravirao-journal-content'),
            'search_items' => __('Search Gallery', 'ravirao-journal-content'),
            'not_found' => __('No gallery items found.', 'ravirao-journal-content'),
            'all_items' => __('All Gallery Items', 'ravirao-journal-content'),
            'menu_name' => __('Gallery', 'ravirao-journal-content'),
        ],
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'gallery', 'with_front' => false],
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions', 'page-attributes', 'custom-fields'],
    ]);

    register_taxonomy('journal_type', ['journal', 'gallery'], [
        'labels' => [
            'name' => __('Types', 'ravirao-journal-content'),
            'singular_name' => __('Type', 'ravirao-journal-content'),
            'search_items' => __('Search Types', 'ravirao-journal-content'),
            'all_items' => __('All Types', 'ravirao-journal-content'),
            'edit_item' => __('Edit Type', 'ravirao-journal-content'),
            'add_new_item' => __('Add New Type', 'ravirao-journal-content'),
            'menu_name' => __('Types', 'ravirao-journal-content'),
        ],
        'public' => true,
        'hierarchical' => false,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'journal-type', 'with_front' => false],
    ]);

    register_taxonomy('journal_topic', ['journal', 'gallery'], [
        'labels' => [
            'name' => __('Topics', 'ravirao-journal-content'),
            'singular_name' => __('Topic', 'ravirao-journal-content'),
            'search_items' => __('Search Topics', 'ravirao-journal-content'),
            'all_items' => __('All Topics', 'ravirao-journal-content'),
            'parent_item' => __('Parent Topic', 'ravirao-journal-content'),
            'parent_item_colon' => __('Parent Topic:', 'ravirao-journal-content'),
            'edit_item' => __('Edit Topic', 'ravirao-journal-content'),
            'add_new_item' => __('Add New Topic', 'ravirao-journal-content'),
            'menu_name' => __('Topics', 'ravirao-journal-content'),
        ],
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'journal-topic', 'with_front' => false],
    ]);
}
add_action('init', 'ravirao_journal_register_content_types', 0);

function ravirao_journal_seed_taxonomy_terms() {
    $types = [
        'article' => __('Article', 'ravirao-journal-content'),
        'news' => __('News', 'ravirao-journal-content'),
        'press' => __('Press & Interviews', 'ravirao-journal-content'),
        'photo-album' => __('Photo Album', 'ravirao-journal-content'),
        'video' => __('Video', 'ravirao-journal-content'),
    ];

    foreach ($types as $slug => $name) {
        if (!term_exists($slug, 'journal_type')) {
            wp_insert_term($name, 'journal_type', ['slug' => $slug]);
        }
    }

    $topics = [
        'vaastu' => __('Vaastu', 'ravirao-journal-content'),
        'jyotish' => __('Jyotish', 'ravirao-journal-content'),
        'events' => __('Events', 'ravirao-journal-content'),
        'temple-vaastu' => __('Temple Vaastu', 'ravirao-journal-content'),
        'industrial-vaastu' => __('Industrial Vaastu', 'ravirao-journal-content'),
    ];

    foreach ($topics as $slug => $name) {
        if (!term_exists($slug, 'journal_topic')) {
            wp_insert_term($name, 'journal_topic', ['slug' => $slug]);
        }
    }
}

function ravirao_journal_seed_default_terms_once() {
    if (get_option('ravirao_journal_default_terms_seeded')) {
        return;
    }

    ravirao_journal_seed_taxonomy_terms();
    update_option('ravirao_journal_default_terms_seeded', '1', false);
}
add_action('init', 'ravirao_journal_seed_default_terms_once', 11);

function ravirao_journal_flush_rewrite_rules() {
    ravirao_journal_register_content_types();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'ravirao_journal_flush_rewrite_rules');

function ravirao_journal_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_ravirao_journal_classification',
        'title' => __('Journal Classification', 'ravirao-journal-content'),
        'fields' => [
            [
                'key' => 'field_ravirao_journal_classification_tab',
                'label' => __('Classification', 'ravirao-journal-content'),
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ravirao_journal_type_terms',
                'label' => __('Content Type', 'ravirao-journal-content'),
                'name' => 'journal_type_terms',
                'type' => 'taxonomy',
                'taxonomy' => 'journal_type',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 1,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'id',
                'instructions' => __('Choose the section. For Gallery entries, use Photo Album or Video. You can add a new type here.', 'ravirao-journal-content'),
            ],
            [
                'key' => 'field_ravirao_journal_topic_terms',
                'label' => __('Topics', 'ravirao-journal-content'),
                'name' => 'journal_topic_terms',
                'type' => 'taxonomy',
                'taxonomy' => 'journal_topic',
                'field_type' => 'checkbox',
                'add_term' => 1,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'id',
                'layout' => 'vertical',
                'instructions' => __('Select every topic that applies. You can add a new topic here.', 'ravirao-journal-content'),
            ],
        ],
        'location' => [
            [['param' => 'post_type', 'operator' => '==', 'value' => 'journal']],
            [['param' => 'post_type', 'operator' => '==', 'value' => 'gallery']],
        ],
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_ravirao_journal_editorial',
        'title' => __('Journal Editorial Details', 'ravirao-journal-content'),
        'fields' => [
            [
                'key' => 'field_ravirao_journal_editorial_tab',
                'label' => __('Editorial Details', 'ravirao-journal-content'),
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ravirao_journal_featured',
                'label' => __('Feature this article', 'ravirao-journal-content'),
                'name' => 'journal_featured',
                'type' => 'true_false',
                'ui' => 1,
                'ui_on_text' => __('Featured', 'ravirao-journal-content'),
                'ui_off_text' => __('Not featured', 'ravirao-journal-content'),
                'instructions' => __('Show this article in the featured section of the Journal page.', 'ravirao-journal-content'),
            ],
            [
                'key' => 'field_ravirao_journal_external_url',
                'label' => __('External article or order URL', 'ravirao-journal-content'),
                'name' => 'journal_external_url',
                'type' => 'url',
                'instructions' => __('Optional. Use this when a news or press item should link to an external source.', 'ravirao-journal-content'),
            ],
        ],
        'location' => [
            [['param' => 'post_type', 'operator' => '==', 'value' => 'journal']],
        ],
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_ravirao_gallery_media',
        'title' => __('Gallery Media', 'ravirao-journal-content'),
        'fields' => [
            [
                'key' => 'field_ravirao_gallery_media_tab',
                'label' => __('Media', 'ravirao-journal-content'),
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ravirao_gallery_video_url',
                'label' => __('Video URL', 'ravirao-journal-content'),
                'name' => 'gallery_video_url',
                'type' => 'url',
                'instructions' => __('For Video entries, paste the YouTube URL (Vimeo and direct MP4/WebM URLs are also supported). Add albums with the Gallery block instead.', 'ravirao-journal-content'),
            ],
            [
                'key' => 'field_ravirao_gallery_album_help',
                'label' => __('Photo Albums', 'ravirao-journal-content'),
                'name' => 'gallery_album_help',
                'type' => 'message',
                'message' => __('For a Photo Album, add images and captions to the main editor using a Gallery block. Set a featured image for the archive card.', 'ravirao-journal-content'),
                'new_lines' => 'wpautop',
                'esc_html' => 1,
            ],
        ],
        'location' => [
            [['param' => 'post_type', 'operator' => '==', 'value' => 'gallery']],
        ],
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ]);
}
add_action('acf/init', 'ravirao_journal_register_acf_fields');

function ravirao_journal_clear_legacy_meta_after_acf_save($post_id) {
    $post_type = get_post_type($post_id);
    $submitted_fields = isset($_POST['acf']) && is_array($_POST['acf']) ? $_POST['acf'] : [];

    if ($post_type === 'journal' && array_key_exists('field_ravirao_journal_featured', $submitted_fields)) {
        delete_post_meta($post_id, '_ravirao_journal_featured');
    }
    if ($post_type === 'journal' && array_key_exists('field_ravirao_journal_external_url', $submitted_fields)) {
        delete_post_meta($post_id, '_ravirao_journal_external_url');
    }
    if ($post_type === 'gallery' && array_key_exists('field_ravirao_gallery_video_url', $submitted_fields)) {
        delete_post_meta($post_id, '_ravirao_gallery_video_url');
    }
}

function ravirao_journal_remove_native_taxonomy_boxes() {
    foreach (['journal', 'gallery'] as $post_type) {
        remove_meta_box('tagsdiv-journal_type', $post_type, 'side');
        remove_meta_box('journal_topicdiv', $post_type, 'side');
    }
}

function ravirao_journal_add_editorial_meta_boxes() {
    add_meta_box(
        'ravirao-journal-editorial',
        __('Journal Display Options', 'ravirao-journal-content'),
        'ravirao_journal_render_editorial_meta_box',
        ['journal', 'gallery'],
        'side',
        'default'
    );
}

function ravirao_journal_render_editorial_meta_box($post) {
    wp_nonce_field('ravirao_journal_save_editorial', 'ravirao_journal_editorial_nonce');
    $featured = get_post_meta($post->ID, '_ravirao_journal_featured', true);
    $external_url = get_post_meta($post->ID, '_ravirao_journal_external_url', true);
    $video_url = get_post_meta($post->ID, '_ravirao_gallery_video_url', true);
    ?>
    <?php if ($post->post_type === 'journal') : ?>
        <p>
            <label>
                <input type="checkbox" name="ravirao_journal_featured" value="1" <?php checked($featured, '1'); ?>>
                <?php esc_html_e('Feature this article on the Journal page', 'ravirao-journal-content'); ?>
            </label>
        </p>
    <?php endif; ?>
    <p>
        <label for="ravirao_journal_external_url"><strong><?php esc_html_e('External feature or order URL', 'ravirao-journal-content'); ?></strong></label>
        <input class="widefat" type="url" id="ravirao_journal_external_url" name="ravirao_journal_external_url" value="<?php echo esc_attr($external_url); ?>">
    </p>
    <?php if ($post->post_type === 'gallery') : ?>
        <p>
            <label for="ravirao_gallery_video_url"><strong><?php esc_html_e('Video URL (for Video type)', 'ravirao-journal-content'); ?></strong></label>
            <input class="widefat" type="url" id="ravirao_gallery_video_url" name="ravirao_gallery_video_url" value="<?php echo esc_attr($video_url); ?>">
        </p>
        <p class="description"><?php esc_html_e('For videos, add a YouTube URL in this field. For photo albums, add images and captions in the editor using the Gallery block.', 'ravirao-journal-content'); ?></p>
    <?php endif; ?>
    <?php
}

function ravirao_journal_save_editorial_meta($post_id) {
    if (
        !isset($_POST['ravirao_journal_editorial_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ravirao_journal_editorial_nonce'])), 'ravirao_journal_save_editorial') ||
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        wp_is_post_revision($post_id) ||
        !current_user_can('edit_post', $post_id)
    ) {
        return;
    }

    if (get_post_type($post_id) === 'journal') {
        if (isset($_POST['ravirao_journal_featured'])) {
            update_post_meta($post_id, '_ravirao_journal_featured', '1');
        } else {
            delete_post_meta($post_id, '_ravirao_journal_featured');
        }
    }

    if (isset($_POST['ravirao_journal_external_url'])) {
        update_post_meta(
            $post_id,
            '_ravirao_journal_external_url',
            esc_url_raw(wp_unslash($_POST['ravirao_journal_external_url']))
        );
    }

    if (get_post_type($post_id) === 'gallery' && isset($_POST['ravirao_gallery_video_url'])) {
        update_post_meta(
            $post_id,
            '_ravirao_gallery_video_url',
            esc_url_raw(wp_unslash($_POST['ravirao_gallery_video_url']))
        );
    }
}
if (function_exists('acf_add_local_field_group')) {
    add_action('add_meta_boxes', 'ravirao_journal_remove_native_taxonomy_boxes', 99);
    add_action('acf/save_post', 'ravirao_journal_clear_legacy_meta_after_acf_save', 20);
} else {
    add_action('add_meta_boxes', 'ravirao_journal_add_editorial_meta_boxes');
    add_action('save_post_journal', 'ravirao_journal_save_editorial_meta');
    add_action('save_post_gallery', 'ravirao_journal_save_editorial_meta');
}

function ravirao_journal_design_entries() {
    return [
        [
            'post_type' => 'journal',
            'slug' => 'from-soil-to-soul-bhoomi-poojan',
            'title' => 'From Soil to Soul: The Untold Power of Bhoomi Poojan in Vaastu Shastra',
            'excerpt' => 'Discover why Bhoomi Poojan is the spiritual foundation of every auspicious construction and how it connects the energies of land, cosmos, and you.',
            'content' => 'Long before blueprints were drafted or cement was poured, ancient Indian builders began every project the same way: by pausing. They walked the land. They sat on it. They offered prayers and whispered mantras into the soil. Only then—after performing Bhoomi Poojan, the ceremonial invocation of the Earth’s spirit—was the first stone set.',
            'type' => 'article',
            'topics' => ['vaastu'],
            'date' => '2024-07-03 09:00:00',
            'image' => 'trowel.jpg',
            'featured' => true,
        ],
        [
            'post_type' => 'journal',
            'slug' => 'vaastu-rented-spaces',
            'title' => 'Not Your Home? Not a Problem: Vaastu Hacks for Rented Spaces That Actually Work',
            'excerpt' => 'Practical and effective Vaastu tips for tenants—bring harmony and success even when you can’t renovate your space completely.',
            'type' => 'article',
            'topics' => ['vaastu'],
            'date' => '2024-07-02 09:00:00',
        ],
        [
            'post_type' => 'journal',
            'slug' => 'vaastu-compliant-storage-factory-output',
            'title' => 'Hidden Wealth: How Vaastu-Compliant Storage Can Boost Factory Output and Harmony',
            'excerpt' => 'Unlock the secrets of storage placement as per Vaastu—improve productivity, cash flow, and relationships at your workplace or factory.',
            'type' => 'article',
            'topics' => ['vaastu'],
            'date' => '2024-07-01 09:00:00',
        ],
        [
            'post_type' => 'journal',
            'slug' => 'dr-ravi-rao-books-on-amazon',
            'title' => 'Dr. Ravi Rao’s books are now available on Amazon',
            'excerpt' => 'A Nation’s Prophecy, Sports Astrology and Vaastu Shastra for Everyone can now be ordered on Amazon.in.',
            'type' => 'news',
            'topics' => ['jyotish'],
            'date' => '2026-09-01 09:00:00',
            'image' => 'bk-prophecy.png',
        ],
        [
            'post_type' => 'journal',
            'slug' => 'the-cio-world-cover-story',
            'title' => 'The CIO World cover story',
            'excerpt' => 'The Impact Leaders 2026',
            'type' => 'press',
            'topics' => ['vaastu'],
            'date' => '2026-09-01 09:00:00',
            'image' => 'mag-cio.png',
        ],
        [
            'post_type' => 'journal',
            'slug' => 'passion-vista-cover-story',
            'title' => 'Passion Vista Cover Story',
            'excerpt' => '',
            'type' => 'press',
            'topics' => ['vaastu'],
            'date' => '2025-01-01 09:00:00',
            'image' => 'press1.jpg',
        ],
        [
            'post_type' => 'journal',
            'slug' => 'television-interviews',
            'title' => 'Television Interviews',
            'excerpt' => '',
            'type' => 'press',
            'topics' => ['jyotish'],
            'date' => '2025-01-01 09:00:00',
            'image' => 'tv.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'temple-projects',
            'title' => 'Temple Projects',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['temple-vaastu'],
            'image' => 'temple.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'credai-foundation-day',
            'title' => 'CREDAI Foundation Day',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['events'],
            'image' => 'credai.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'icas-programme',
            'title' => 'ICAS Programme',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['events', 'jyotish'],
            'image' => 'icas.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'ganesha-shrine',
            'title' => 'Ganesha Shrine',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['temple-vaastu'],
            'image' => 'shrine2.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'gathering-of-vedic-scholars',
            'title' => 'Gathering of Vedic Scholars',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['events', 'jyotish'],
            'image' => 'gal-group.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'homa-ceremony',
            'title' => 'Homa Ceremony',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['events', 'vaastu'],
            'image' => 'gal-homa.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'at-the-printing-press',
            'title' => 'At the Printing Press',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['events'],
            'image' => 'print.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'manufacturing-unit-visit',
            'title' => 'Manufacturing Unit Visit',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['industrial-vaastu'],
            'image' => 'gal-plant.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'steel-plant-visit',
            'title' => 'Steel Plant Visit',
            'excerpt' => '',
            'type' => 'photo-album',
            'topics' => ['industrial-vaastu'],
            'image' => 'steel.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'transform-your-business-landscape',
            'title' => 'Transform Your Business Landscape With Dr. Ravi Rao’s Vaastu Experts',
            'excerpt' => '',
            'type' => 'video',
            'topics' => ['vaastu'],
            'image' => 'vid1.jpg',
        ],
        [
            'post_type' => 'gallery',
            'slug' => 'textile-industry-growth-analysis',
            'title' => 'Dr. Ravi Rao’s Analysis of 2017 Textile Industry Growth',
            'excerpt' => '',
            'type' => 'video',
            'topics' => ['jyotish'],
            'image' => 'vid2.jpg',
        ],
    ];
}

function ravirao_journal_import_design_image($filename) {
    $existing = get_posts([
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'meta_key' => '_ravirao_journal_design_asset',
        'meta_value' => $filename,
        'posts_per_page' => 1,
        'fields' => 'ids',
    ]);
    if ($existing) {
        return (int) $existing[0];
    }

    $source = get_theme_file_path('/assets/images/journal/' . $filename);
    if (!is_readable($source)) {
        return new WP_Error('missing_journal_asset', sprintf(__('The design image %s is missing from the theme.', 'ravirao-journal-content'), $filename));
    }

    $contents = file_get_contents($source);
    if ($contents === false) {
        return new WP_Error('unreadable_journal_asset', sprintf(__('The design image %s could not be read.', 'ravirao-journal-content'), $filename));
    }

    $upload = wp_upload_bits($filename, null, $contents);
    if (!empty($upload['error'])) {
        return new WP_Error('journal_asset_upload_failed', $upload['error']);
    }

    $filetype = wp_check_filetype($filename, null);
    $attachment_id = wp_insert_attachment([
        'post_mime_type' => $filetype['type'],
        'post_title' => sanitize_text_field(pathinfo($filename, PATHINFO_FILENAME)),
        'post_status' => 'inherit',
    ], $upload['file'], 0, true);
    if (is_wp_error($attachment_id)) {
        return $attachment_id;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    $metadata = wp_generate_attachment_metadata($attachment_id, $upload['file']);
    if (is_wp_error($metadata) || $metadata === false) {
        return is_wp_error($metadata) ? $metadata : new WP_Error('journal_asset_metadata_failed', sprintf(__('Metadata could not be generated for %s.', 'ravirao-journal-content'), $filename));
    }
    wp_update_attachment_metadata($attachment_id, $metadata);
    update_post_meta($attachment_id, '_ravirao_journal_design_asset', $filename);

    return (int) $attachment_id;
}

function ravirao_journal_import_design_entries() {
    $published = 0;
    foreach (ravirao_journal_design_entries() as $item) {
        $existing = get_page_by_path($item['slug'], OBJECT, $item['post_type']);
        $is_tagged_design_entry = $existing && get_post_meta($existing->ID, '_ravirao_journal_design_content', true);
        $is_legacy_design_draft = $existing &&
            $existing->post_title === $item['title'] &&
            $existing->post_status !== 'publish';

        if ($existing && !$is_tagged_design_entry && !$is_legacy_design_draft) {
            continue;
        }

        $attachment_id = 0;
        if ($existing) {
            $post_id = (int) $existing->ID;
            if ($existing->post_status !== 'publish') {
                $updated_post_id = wp_update_post([
                    'ID' => $post_id,
                    'post_status' => 'publish',
                ], true);
                if (is_wp_error($updated_post_id)) {
                    return $updated_post_id;
                }
                $published++;
            }
            $attachment_id = (int) get_post_thumbnail_id($post_id);
        } else {
            if (!empty($item['image'])) {
                $attachment_id = ravirao_journal_import_design_image($item['image']);
                if (is_wp_error($attachment_id)) {
                    return $attachment_id;
                }
            }

            $post_data = [
                'post_type' => $item['post_type'],
                'post_status' => 'publish',
                'post_name' => $item['slug'],
                'post_title' => $item['title'],
                'post_excerpt' => $item['excerpt'],
                'post_content' => isset($item['content']) ? $item['content'] : '',
            ];
            if (isset($item['date'])) {
                $post_data['post_date'] = $item['date'];
            }

            $post_id = wp_insert_post($post_data, true);
            if (is_wp_error($post_id)) {
                return $post_id;
            }
            update_post_meta($post_id, '_ravirao_journal_design_content', '1');
            $published++;
        }

        if ($existing) {
            update_post_meta($post_id, '_ravirao_journal_design_content', '1');
        }

        if (!$attachment_id && !empty($item['image'])) {
            $attachment_id = ravirao_journal_import_design_image($item['image']);
            if (is_wp_error($attachment_id)) {
                return $attachment_id;
            }
        }

        $type_result = wp_set_object_terms($post_id, $item['type'], 'journal_type');
        if (is_wp_error($type_result)) {
            return $type_result;
        }
        $topic_result = wp_set_object_terms($post_id, $item['topics'], 'journal_topic');
        if (is_wp_error($topic_result)) {
            return $topic_result;
        }
        if (!empty($item['featured'])) {
            if (function_exists('update_field')) {
                update_field('field_ravirao_journal_featured', 1, $post_id);
                delete_post_meta($post_id, '_ravirao_journal_featured');
            } else {
                update_post_meta($post_id, '_ravirao_journal_featured', '1');
            }
        }

        if ($attachment_id) {
            if (get_post_thumbnail_id($post_id) !== $attachment_id && !set_post_thumbnail($post_id, $attachment_id)) {
                return new WP_Error('journal_featured_image_failed', sprintf(__('The design image could not be assigned to %s.', 'ravirao-journal-content'), $item['title']));
            }
        }
    }

    return $published;
}

function ravirao_journal_maybe_import_design_content() {
    if (!current_user_can('manage_options') || get_option('ravirao_journal_design_content_imported')) {
        return;
    }

    $lock_option = 'ravirao_journal_design_content_import_lock';
    if (!add_option($lock_option, time(), '', false)) {
        $lock_time = (int) get_option($lock_option);
        if (!$lock_time || $lock_time >= time() - 300) {
            return;
        }

        delete_option($lock_option);
        if (!add_option($lock_option, time(), '', false)) {
            return;
        }
    }

    try {
        if (get_option('ravirao_journal_design_content_imported')) {
            return;
        }

        $result = ravirao_journal_import_design_entries();
        if (!is_wp_error($result)) {
            update_option('ravirao_journal_design_content_imported', '1', false);
        }
        set_transient('ravirao_journal_import_notice_' . get_current_user_id(), $result, HOUR_IN_SECONDS);
    } finally {
        delete_option($lock_option);
    }
}
add_action('admin_init', 'ravirao_journal_maybe_import_design_content', 20);

function ravirao_journal_cleanup_duplicate_gallery_design_entries() {
    if (
        !current_user_can('manage_options') ||
        get_option('ravirao_journal_gallery_duplicates_cleaned') ||
        get_option('ravirao_journal_design_content_import_lock')
    ) {
        return;
    }

    $lock_option = 'ravirao_journal_gallery_deduplication_lock';
    if (!add_option($lock_option, time(), '', false)) {
        return;
    }

    try {
        if (get_option('ravirao_journal_gallery_duplicates_cleaned')) {
            return;
        }

        $design_posts = get_posts([
            'post_type' => 'gallery',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'fields' => 'ids',
        ]);
        $trashed_count = 0;
        $failed_titles = [];

        foreach (ravirao_journal_design_entries() as $item) {
            if ($item['post_type'] !== 'gallery') {
                continue;
            }

            $topic_slugs = $item['topics'];
            sort($topic_slugs);
            $matches = [];

            foreach ($design_posts as $post_id) {
                $post = get_post($post_id);
                if (!$post || $post->post_title !== $item['title']) {
                    continue;
                }

                $is_expected_slug = $post->post_name === $item['slug'] ||
                    preg_match('/^' . preg_quote($item['slug'], '/') . '-[0-9]+$/', $post->post_name);
                if (!$is_expected_slug) {
                    continue;
                }

                $post_types = wp_get_object_terms($post_id, 'journal_type', ['fields' => 'slugs']);
                $post_topics = wp_get_object_terms($post_id, 'journal_topic', ['fields' => 'slugs']);
                if (is_wp_error($post_types) || is_wp_error($post_topics)) {
                    continue;
                }

                sort($post_types);
                sort($post_topics);
                if ($post_types !== [$item['type']] || $post_topics !== $topic_slugs) {
                    continue;
                }

                if (!empty($item['image'])) {
                    $thumbnail_id = get_post_thumbnail_id($post_id);
                    if (
                        !$thumbnail_id ||
                        get_post_meta($thumbnail_id, '_ravirao_journal_design_asset', true) !== $item['image']
                    ) {
                        continue;
                    }
                }

                $matches[] = (int) $post_id;
            }

            if (count($matches) < 2) {
                continue;
            }

            usort($matches, function ($first_id, $second_id) use ($item) {
                $first_is_canonical = get_post_field('post_name', $first_id) === $item['slug'];
                $second_is_canonical = get_post_field('post_name', $second_id) === $item['slug'];
                if ($first_is_canonical !== $second_is_canonical) {
                    return $first_is_canonical ? -1 : 1;
                }

                return $first_id <=> $second_id;
            });
            array_shift($matches);

            foreach ($matches as $duplicate_id) {
                if (wp_trash_post($duplicate_id)) {
                    $trashed_count++;
                } else {
                    $failed_titles[] = $item['title'];
                }
            }
        }

        if ($failed_titles) {
            set_transient(
                'ravirao_journal_gallery_deduplication_notice_' . get_current_user_id(),
                new WP_Error(
                    'journal_gallery_deduplication_failed',
                    sprintf(
                        __('Some duplicate Gallery entries could not be moved to Trash: %s', 'ravirao-journal-content'),
                        implode(', ', array_unique($failed_titles))
                    )
                ),
                HOUR_IN_SECONDS
            );
            return;
        }

        update_option('ravirao_journal_gallery_duplicates_cleaned', '1', false);
        if ($trashed_count) {
            set_transient(
                'ravirao_journal_gallery_deduplication_notice_' . get_current_user_id(),
                $trashed_count,
                HOUR_IN_SECONDS
            );
        }
    } finally {
        delete_option($lock_option);
    }
}
add_action('admin_init', 'ravirao_journal_cleanup_duplicate_gallery_design_entries', 30);

function ravirao_journal_show_design_import_notice() {
    if (!current_user_can('manage_options')) {
        return;
    }
    $notice = get_transient('ravirao_journal_import_notice_' . get_current_user_id());
    if (!$notice) {
        return;
    }
    delete_transient('ravirao_journal_import_notice_' . get_current_user_id());

    if (is_wp_error($notice)) {
        echo '<div class="notice notice-error"><p>' . esc_html($notice->get_error_message()) . '</p></div>';
        return;
    }

    $count = (int) $notice;
    $message = $count
        ? sprintf(_n('%s design entry was published.', '%s design entries were published.', $count, 'ravirao-journal-content'), number_format_i18n($count))
        : __('Design content is ready; matching published entries were left unchanged.', 'ravirao-journal-content');
    echo '<div class="notice notice-success"><p>' . esc_html($message) . '</p></div>';
}
add_action('admin_notices', 'ravirao_journal_show_design_import_notice');

function ravirao_journal_show_gallery_deduplication_notice() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $notice_key = 'ravirao_journal_gallery_deduplication_notice_' . get_current_user_id();
    $notice = get_transient($notice_key);
    if (!$notice) {
        return;
    }
    delete_transient($notice_key);

    if (is_wp_error($notice)) {
        echo '<div class="notice notice-error"><p>' . esc_html($notice->get_error_message()) . '</p></div>';
        return;
    }

    $message = sprintf(
        _n('%s duplicate Gallery entry was moved to Trash. You can restore it from the Trash if needed.', '%s duplicate Gallery entries were moved to Trash. You can restore them from the Trash if needed.', (int) $notice, 'ravirao-journal-content'),
        number_format_i18n((int) $notice)
    );
    echo '<div class="notice notice-success"><p>' . esc_html($message) . '</p></div>';
}
add_action('admin_notices', 'ravirao_journal_show_gallery_deduplication_notice');

function ravirao_journal_add_content_setup_page() {
    add_management_page(
        __('Journal Content Setup', 'ravirao-journal-content'),
        __('Journal Content Setup', 'ravirao-journal-content'),
        'manage_options',
        'ravirao-journal-content',
        'ravirao_journal_render_content_setup_page'
    );
}
add_action('admin_menu', 'ravirao_journal_add_content_setup_page');

function ravirao_journal_render_content_setup_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
      <h1><?php esc_html_e('Journal Content Setup', 'ravirao-journal-content'); ?></h1>
      <?php if (get_option('ravirao_journal_design_content_imported')) : ?>
        <p><?php esc_html_e('The Journal and Gallery examples from the approved design have been added as published entries, with their Types, Topics, and design images. They are now editable from the Journal and Gallery menus.', 'ravirao-journal-content'); ?></p>
      <?php else : ?>
        <p><?php esc_html_e('The theme will import and publish the approved design examples on the next admin request. If an import error occurs, it will be shown above and the theme will retry on your next visit.', 'ravirao-journal-content'); ?></p>
      <?php endif; ?>
    </div>
    <?php
}
