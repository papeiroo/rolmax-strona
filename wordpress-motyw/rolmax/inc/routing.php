<?php
/**
 * Przekierowania 301 i zgodność ze starymi adresami rolmax.net.pl.
 */
defined('ABSPATH') || exit;

/** Przekierowania sprawdzane przed WordPressem (najszybciej, bez zapytań do bazy). */
add_action('parse_request', function () {
    $uri  = $_SERVER['REQUEST_URI'] ?? '/';
    $path = rawurldecode((string)parse_url($uri, PHP_URL_PATH));
    $base = rtrim((string)parse_url(home_url(), PHP_URL_PATH), '/');
    if ($base !== '' && str_starts_with($path, $base)) $path = substr($path, strlen($base));
    $q = (string)parse_url($uri, PHP_URL_QUERY);
    parse_str($q, $qs);
    $go = function (string $to) { wp_safe_redirect(str_starts_with($to, 'http') ? $to : home_url($to), 301, 'Rolmax'); exit; };

    if ($path === '' || $path === '/') { if ($q === '') $go('/pl'); return; }                  // strona główna → /pl
    if (preg_match('#^/(en|de|ru)(/.*)?$#', $path, $m)) $go('/pl' . rtrim($m[2] ?? '', '/'));   // dawne wersje językowe (polska treść)
    if (str_starts_with($path, '/pl/strony/https:')) {                                          // błędny link Blue & you
        add_filter('allowed_redirect_hosts', fn($h) => array_merge($h, ['cnhi-dealer-rolmax.webmag.io']));
        $go('https://cnhi-dealer-rolmax.webmag.io/rolnictwo-precyzyjne-2026/start');
    }
    if (rtrim($path, '/') === '/pl/strony') $go('/pl/strony/o-nas');
    if (rtrim($path, '/') === '/pl/galerie' && !empty($qs['page']) && (int)$qs['page'] > 1) $go('/pl/galerie/page/' . (int)$qs['page']);
}, 1);

/* Lista aktualności używa ?page=N jak dotychczas — nie pozwól WordPressowi tego przepisywać. */
add_filter('redirect_canonical', function ($redirect, $requested) {
    if (is_page() && in_array(get_page_template_slug(get_queried_object_id()), ['page-templates/tpl-aktualnosci.php', 'page-templates/tpl-promocje.php'], true)) return false;
    return $redirect;
}, 10, 2);

/* WordPress traktuje ?page=N na stronie jako numer podstrony treści i zwraca 404 — dla listy aktualności to numer strony listy. */
add_filter('pre_handle_404', function ($pre, $wp_query) {
    if ($wp_query->is_page() && get_query_var('page') && get_page_template_slug($wp_query->get_queried_object_id()) && in_array(get_page_template_slug($wp_query->get_queried_object_id()), ['page-templates/tpl-aktualnosci.php', 'page-templates/tpl-promocje.php'], true)) {
        status_header(200);
        return true;
    }
    return $pre;
}, 10, 2);

/* Ciasteczko działu ustawiane na stronach głównych działów */
add_action('template_redirect', function () {
    if (!is_page()) return;
    $tpl = get_page_template_slug(get_queried_object_id());
    if ($tpl === 'page-templates/tpl-dzial-maszyn.php') rm_remember_dept('maszyny');
    if ($tpl === 'page-templates/tpl-dzial-czesci.php') rm_remember_dept('czesci');
});
