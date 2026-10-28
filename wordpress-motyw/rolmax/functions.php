<?php
/**
 * Motyw Rolmax — plik startowy.
 */
defined('ABSPATH') || exit;

define('RM_VER', '1.0.0');
define('RM_DIR', get_template_directory());
define('RM_URI', get_template_directory_uri());

require RM_DIR . '/inc/helpers.php';
require RM_DIR . '/inc/content-types.php';
require RM_DIR . '/inc/branches.php';
require RM_DIR . '/inc/customizer.php';
require RM_DIR . '/inc/routing.php';
require RM_DIR . '/inc/seo.php';
require RM_DIR . '/inc/importer.php';

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_image_size('rm-card', 800, 500, true);
    add_image_size('rm-hero', 1920, 1080, true);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('rm-fonts', 'https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@300;500;700;800&family=Instrument+Serif:ital@0;1&family=Hanken+Grotesk:wght@400;500;600;700&display=swap', [], null);
    wp_enqueue_style('rm-app', RM_URI . '/assets/css/app.css', ['rm-fonts'], filemtime(RM_DIR . '/assets/css/app.css'));
    wp_enqueue_script('rm-app', RM_URI . '/assets/js/app.js', [], filemtime(RM_DIR . '/assets/js/app.js'), ['strategy' => 'defer', 'in_footer' => true]);
    // Motyw nie korzysta z bloków na froncie poza treścią stron — zostawiamy style bloków.
});

add_filter('wp_resource_hints', function ($urls, $rel) {
    if ($rel === 'preconnect') {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin'];
    }
    return $urls;
}, 10, 2);

/* Panel: ukryj „Komentarze” — firma ich nie używa. */
add_action('admin_menu', fn() => remove_menu_page('edit-comments.php'));
add_filter('comments_open', '__return_false');
