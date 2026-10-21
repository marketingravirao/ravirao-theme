<?php
if (!defined('ABSPATH')) { exit; }

define('RAVIRAO_THEME_VERSION', wp_get_theme()->get('Version'));

add_action('after_setup_theme', function () {
    load_theme_textdomain('ravirao-theme', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('custom-logo', ['height' => 80, 'width' => 240, 'flex-height' => true, 'flex-width' => true]);
    register_nav_menus(['primary' => __('Main Menu', 'ravirao-theme'), 'footer' => __('Footer Menu', 'ravirao-theme')]);
});

function ravirao_theme_asset_version($relative_path) {
    $file = get_theme_file_path($relative_path);

    if (file_exists($file)) {
        return (string) filemtime($file);
    }

    return RAVIRAO_THEME_VERSION;
}

function ravirao_theme_style($handle, $relative, $deps = []) {
    if (file_exists(get_theme_file_path($relative))) {
        wp_enqueue_style($handle, get_theme_file_uri($relative), $deps, ravirao_theme_asset_version($relative));
    }
}
function ravirao_theme_script($handle, $relative, $deps = []) {
    if (file_exists(get_theme_file_path($relative))) {
        wp_enqueue_script($handle, get_theme_file_uri($relative), $deps, ravirao_theme_asset_version($relative), true);
    }
}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('dashicons');
    ravirao_theme_style('ravirao-theme-base', '/assets/css/base.css');
    ravirao_theme_style('ravirao-theme-header', '/assets/css/header.css', ['ravirao-theme-base']);
    ravirao_theme_style('ravirao-theme-footer', '/assets/css/footer.css', ['ravirao-theme-base']);
    ravirao_theme_script('ravirao-theme-main', '/assets/js/main.js');

    if (is_front_page() || is_page_template('front-page.php')) {
        ravirao_theme_style('ravirao-theme-homepage', '/assets/css/homepage.css', ['ravirao-theme-base']);
        wp_enqueue_script(
            'ravirao-gsap',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js',
            [],
            '3.13.0',
            true
        );
        wp_enqueue_script(
            'ravirao-scrolltrigger',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js',
            ['ravirao-gsap'],
            '3.13.0',
            true
        );
        ravirao_theme_script('ravirao-theme-homepage', '/assets/js/homepage.js', ['ravirao-scrolltrigger']);
        wp_enqueue_script(
            'leadconnector-form-embed',
            'https://link.msgsndr.com/js/form_embed.js',
            [],
            null,
            true
        );
    } elseif (is_page_template('templates/landing-page.php')) {
        ravirao_theme_style('ravirao-theme-landing', '/assets/css/landing.css', ['ravirao-theme-base']);
        ravirao_theme_script('ravirao-theme-landing', '/assets/js/landing.js');
    } elseif (is_page_template('templates/full-width.php')) {
        ravirao_theme_style('ravirao-theme-full-width', '/assets/css/full-width.css', ['ravirao-theme-base']);
    } elseif (is_page_template('templates/blank-page.php')) {
        ravirao_theme_style('ravirao-theme-blank', '/assets/css/blank.css', ['ravirao-theme-base']);
    }
});

add_filter('body_class', function ($classes) {
    if (is_page_template('templates/blank-page.php')) { $classes[] = 'ravirao-theme-blank-page'; }
    return $classes;
});
