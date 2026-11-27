<?php
if (!defined('ABSPATH')) { exit; }

if (!function_exists('ravirao_journal_register_content_types')) {
    require_once get_template_directory() . '/inc/journal-content.php';
}

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

if (!defined('RAVIRAO_THEME_CONTACT_EMAIL')) {
    // Override in wp-config.php if the public contact address differs.
    define('RAVIRAO_THEME_CONTACT_EMAIL', 'office@ravirao.com');
}

/** Cache-bust local theme assets after changes, falling back to the theme version. */
function ravirao_theme_asset_version($relative_path) {
    $file = get_theme_file_path($relative_path);
    if (file_exists($file)) {
        $modified = filemtime($file);
        if ($modified !== false) {
            return (string) $modified;
        }
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

/** True when the current page uses any of the given page templates (paths relative to the theme). */
function ravirao_theme_is_template(array $templates) {
    foreach ($templates as $template) {
        if (is_page_template($template)) {
            return true;
        }
    }
    return false;
}

/** GSAP + ScrollTrigger from cdnjs. Returns the handle to depend on. */
function ravirao_theme_enqueue_gsap() {
    $version = '3.13.0';
    $base = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/' . $version . '/';
    wp_enqueue_script('ravirao-gsap', $base . 'gsap.min.js', [], $version, true);
    wp_enqueue_script('ravirao-scrolltrigger', $base . 'ScrollTrigger.min.js', ['ravirao-gsap'], $version, true);
    return 'ravirao-scrolltrigger';
}

/**
 * Reviews slider (template-parts/sections/industry-testimonials.php): Swiper from cdnjs
 * plus the theme's slider styles and init script. Safe to call more than once.
 */
function ravirao_theme_enqueue_reviews_slider() {
    $version = '11.1.14';
    $base = 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/' . $version . '/';
    wp_enqueue_style('ravirao-swiper', $base . 'swiper-bundle.min.css', [], $version);
    wp_enqueue_script('ravirao-swiper', $base . 'swiper-bundle.min.js', [], $version, true);
    ravirao_theme_style('ravirao-theme-reviews-slider', '/assets/css/reviews-slider.css', ['ravirao-theme-base', 'ravirao-swiper']);
    ravirao_theme_script('ravirao-theme-reviews-slider', '/assets/js/reviews-slider.js', ['ravirao-swiper']);
}

add_action('wp_enqueue_scripts', function () {
    // Pages that show the reviews section load the slider in the <head> (no flash of unstyled slides).
    if (is_front_page() || is_page_template('front-page.php') || ravirao_theme_is_template([
        'templates/industrial-vaastu.php',
        'templates/about-publications.php',
    ])) {
        ravirao_theme_enqueue_reviews_slider();
    }
}, 20);

add_action('wp_enqueue_scripts', function () {
    $about_subpages = [
        'templates/about-vaastu.php',
        'templates/about-dr-ravi-rao.php',
        'templates/about-publications.php',
        'templates/about-academic-contribution.php',
        'templates/about-workshops-seminars.php',
    ];
    wp_enqueue_style('dashicons');
    ravirao_theme_style('ravirao-theme-base', '/assets/css/base.css');
    ravirao_theme_style('ravirao-theme-header', '/assets/css/header.css', ['ravirao-theme-base']);
    ravirao_theme_style('ravirao-theme-footer', '/assets/css/footer.css', ['ravirao-theme-base']);
    ravirao_theme_script('ravirao-theme-main', '/assets/js/main.js');

    // Enqueued by the footer or homepage template where the form is rendered.
    wp_register_script('leadconnector-form-embed', 'https://link.msgsndr.com/js/form_embed.js', [], null, true);

    if (is_front_page() || is_page_template('front-page.php')) {
        wp_enqueue_style(
            'ravirao-theme-homepage-fonts',
            'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap',
            [],
            null
        );
        ravirao_theme_style('ravirao-theme-homepage', '/assets/css/homepage-design.css', ['ravirao-theme-base']);
        ravirao_theme_style('ravirao-theme-travel-calendar', '/assets/css/travel-calendar.css', ['ravirao-theme-homepage']);
        ravirao_theme_script('ravirao-theme-homepage', '/assets/js/homepage-design.js');
        wp_enqueue_script('leadconnector-form-embed');
    } elseif (
        is_post_type_archive(['journal', 'gallery']) ||
        is_singular(['journal', 'gallery']) ||
        is_tax('journal_type')
    ) {
        ravirao_theme_style('ravirao-theme-journal', '/assets/css/journal.css', ['ravirao-theme-base']);
        if (is_post_type_archive('journal')) {
            ravirao_theme_style('ravirao-theme-travel-calendar', '/assets/css/travel-calendar.css', ['ravirao-theme-journal']);
        }
        ravirao_theme_script('ravirao-theme-journal', '/assets/js/journal.js');
        wp_enqueue_style(
            'ravirao-theme-journal-fonts',
            'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap',
            [],
            null
        );
    } elseif (is_home() || is_archive() || is_singular('post')) {
        ravirao_theme_style('ravirao-theme-blog', '/assets/css/blog.css', ['ravirao-theme-base']);
    } elseif (ravirao_theme_is_template($about_subpages)) {
        ravirao_theme_style('ravirao-theme-about-page', '/assets/css/about-page.css', ['ravirao-theme-base']);
        ravirao_theme_style('ravirao-theme-about-subpages', '/assets/css/about-subpages.css', ['ravirao-theme-base', 'ravirao-theme-about-page']);
        if (ravirao_theme_is_template(['templates/about-dr-ravi-rao.php', 'templates/about-publications.php'])) {
            ravirao_theme_style('ravirao-theme-homepage', '/assets/css/homepage.css', ['ravirao-theme-base']);
        }
        if (is_page_template('templates/about-dr-ravi-rao.php')) {
            ravirao_theme_style(
                'ravirao-theme-about-dr-ravi-rao',
                '/assets/css/about-dr-ravi-rao.css',
                ['ravirao-theme-base', 'ravirao-theme-about-page', 'ravirao-theme-about-subpages', 'ravirao-theme-homepage']
            );
        }
        if (is_page_template('templates/about-vaastu.php')) {
            ravirao_theme_style(
                'ravirao-theme-about-vaastu',
                '/assets/css/about-vaastu-page.css',
                ['ravirao-theme-base', 'ravirao-theme-about-page', 'ravirao-theme-about-subpages']
            );
            ravirao_theme_script('ravirao-theme-about-vaastu', '/assets/js/about-vaastu.js');
        }
        $gsap = ravirao_theme_enqueue_gsap();
        ravirao_theme_script('ravirao-theme-generic-animations', '/assets/js/generic-animations.js', [$gsap]);
        if (is_page_template('templates/about-workshops-seminars.php')) {
            ravirao_theme_script('ravirao-about-workshops', '/assets/js/about-workshops.js');
        }
        if (is_page_template('templates/about-publications.php')) {
            ravirao_theme_script('ravirao-theme-homepage', '/assets/js/homepage.js', [$gsap]);
        }
    } elseif (is_page_template('templates/client-page.php')) {
        ravirao_theme_style('ravirao-theme-client-page', '/assets/css/client-page.css', ['ravirao-theme-base']);
        ravirao_theme_script('ravirao-theme-generic-animations', '/assets/js/generic-animations.js', [ravirao_theme_enqueue_gsap()]);
        ravirao_theme_script('ravirao-theme-client-page', '/assets/js/client-page.js');
    } elseif (is_page_template('templates/industrial-vaastu.php')) {
        ravirao_theme_style('ravirao-theme-industrial-vaastu', '/assets/css/industrial-vaastu.css', ['ravirao-theme-base']);
        ravirao_theme_script('ravirao-theme-industrial-vaastu-interactions', '/assets/js/industrial-vaastu.js');
        ravirao_theme_script('ravirao-theme-generic-animations', '/assets/js/generic-animations.js', [ravirao_theme_enqueue_gsap()]);
    } elseif (is_page_template('templates/temple-vaastu.php')) {
        wp_enqueue_style(
            'ravirao-theme-temple-fonts',
            'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap',
            [],
            null
        );
        ravirao_theme_style(
            'ravirao-theme-temple-vaastu',
            '/assets/css/temple-vaastu.css',
            ['ravirao-theme-base', 'ravirao-theme-temple-fonts']
        );
        ravirao_theme_script('ravirao-theme-temple-vaastu', '/assets/js/temple-vaastu.js');
    } elseif (is_page_template('templates/residential-vaastu.php')) {
        ravirao_theme_style('ravirao-theme-residential-vaastu', '/assets/css/residential-vaastu.css', ['ravirao-theme-base']);
    } elseif (ravirao_theme_is_template(['templates/about-us.php', 'templates/services.php'])) {
        ravirao_theme_style('ravirao-theme-page-directory', '/assets/css/page-directory.css', ['ravirao-theme-base']);
    } elseif (is_page_template('templates/muhurat-calendar.php')) {
        ravirao_theme_style('ravirao-theme-muhurat-calendar', '/assets/css/muhurat-calendar.css', ['ravirao-theme-base']);
    }

    ravirao_theme_style('ravirao-theme-shared-typography', '/assets/css/shared-typography.css', ['ravirao-theme-base']);
});

add_filter('body_class', function ($classes) {
    if (is_page_template('templates/muhurat-calendar.php')) { $classes[] = 'rr-muhurat-calendar-page'; }
    // Adds the page scope for the Temple Vaastu enquiry-section treatment.
    if (is_page_template('templates/temple-vaastu.php')) { $classes[] = 'rr-temple-vaastu-page'; }
    if (is_page_template('templates/residential-vaastu.php')) { $classes[] = 'rr-residential-vaastu-page'; }
    if (is_post_type_archive(['journal', 'gallery']) || is_singular(['journal', 'gallery']) || is_tax('journal_type')) {
        $classes[] = 'rr-journal-page';
    }
    return $classes;
});
