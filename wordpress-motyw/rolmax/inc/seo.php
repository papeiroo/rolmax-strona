<?php
/**
 * Tytuły w formacie dotychczasowej strony („Rolmax - T8 GENESIS™”), opisy, Open Graph, dane strukturalne.
 * Jeśli zainstalujesz Yoast SEO lub Rank Math, motyw sam wyłączy swoje znaczniki meta i oddaje im kontrolę.
 */
defined('ABSPATH') || exit;

function rm_has_seo_plugin(): bool { return defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || class_exists('All_in_One_SEO_Pack') || defined('AIOSEO_VERSION'); }

add_filter('pre_get_document_title', function ($t) {
    if (rm_has_seo_plugin()) return $t;
    if (is_page() && get_page_template_slug() === 'page-templates/tpl-intro.php') return 'Rolmax - Autoryzowany Przedstawiciel New Holland';
    if (is_singular()) return 'Rolmax - ' . wp_strip_all_tags(single_post_title('', false));
    if (is_tax()) return 'Rolmax - ' . single_term_title('', false);
    if (is_post_type_archive()) return 'Rolmax - ' . (is_post_type_archive('maszyna') ? 'Oferta' : (is_post_type_archive('praca') ? 'Praca' : post_type_archive_title('', false)));
    if (is_404()) return 'Rolmax - Nie znaleziono';
    return $t;
});

function rm_meta_description(): string
{
    if (is_singular()) {
        $p = get_queried_object();
        $d = has_excerpt($p) ? get_the_excerpt($p) : wp_trim_words(wp_strip_all_tags(strip_shortcodes($p->post_content)), 28, '…');
        if (trim($d) !== '') return $d;
    }
    if (is_tax('kategoria-maszyn')) { $d = term_description(); if ($d) return wp_strip_all_tags($d); }
    return 'Rolmax — autoryzowany dealer New Holland od 1997 roku. Maszyny rolnicze, części, serwis i finansowanie. Świdnik, Miączyn, Rudnik, Białka.';
}

add_action('wp_head', function () {
    if (rm_has_seo_plugin()) return;
    $desc = rm_meta_description();
    if (is_singular()) $url = get_permalink();
    elseif (is_tax()) $url = get_term_link(get_queried_object());
    elseif (is_post_type_archive()) $url = get_post_type_archive_link((string)get_query_var('post_type'));
    else $url = home_url('/' . ($GLOBALS['wp']->request ?? ''));
    if (is_wp_error($url)) $url = home_url('/pl');
    echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    if (!is_singular() && !is_404()) echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n"; // strony pojedyncze: canonical dodaje WordPress
    echo '<meta property="og:type" content="website"><meta property="og:site_name" content="Rolmax"><meta property="og:locale" content="pl_PL">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr(wp_get_document_title()) . '"><meta property="og:description" content="' . esc_attr($desc) . '"><meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    if (is_singular() && has_post_thumbnail()) echo '<meta property="og:image" content="' . esc_url(get_the_post_thumbnail_url(null, 'rm-hero')) . '">' . "\n";
    echo '<meta name="theme-color" content="#000B26">' . "\n";
}, 1);

/* Dane strukturalne firmy i oddziałów — strona główna i kontakt */
add_action('wp_head', function () {
    if (!is_page()) return;
    $tpl = get_page_template_slug();
    if (!in_array($tpl, ['page-templates/tpl-intro.php', 'page-templates/tpl-kontakt.php'], true)) return;
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $deps = [];
    foreach (rm_branches() as $b) {
        preg_match('/^(.*), (\d{2}-\d{3}) (.*)$/', $b['a'], $m);
        $src = $b['sales'] ?? $b['parts'];
        if (!$src) continue;
        $h = explode('–', $src[0][0][1] ?? '8:00–16:00');
        $deps[] = ['@type' => 'LocalBusiness', 'name' => 'Rolmax — oddział ' . $b['n'], 'telephone' => '+48 ' . ($src[1][0] ?? rm_opt('phone')), 'email' => $src[2],
            'address' => ['@type' => 'PostalAddress', 'streetAddress' => $m[1] ?? $b['a'], 'postalCode' => $m[2] ?? '', 'addressLocality' => $m[3] ?? $b['n'], 'addressCountry' => 'PL'],
            'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => $days, 'opens' => sprintf('%05s', $h[0] ?? '8:00'), 'closes' => sprintf('%05s', $h[1] ?? '16:00')]]];
    }
    $org = ['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => 'Rolmax', 'url' => home_url('/pl'), 'logo' => rm_asset('img/logo.png'),
        'foundingDate' => rm_opt('founded'), 'telephone' => '+48 ' . rm_opt('phone'), 'email' => rm_opt('email'), 'sameAs' => [rm_opt('facebook'), rm_opt('instagram')], 'department' => $deps];
    echo '<script type="application/ld+json">' . wp_json_encode($org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
});

/* Mapa strony WordPressa: bez użytkowników i oddziałów (dane wewnętrzne) */
add_filter('wp_sitemaps_add_provider', fn($p, $name) => $name === 'users' ? false : $p, 10, 2);
add_filter('wp_sitemaps_post_types', function ($t) { unset($t['oddzial']); return $t; });
