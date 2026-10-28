<?php
/**
 * Funkcje pomocnicze motywu.
 */
defined('ABSPATH') || exit;

/** Dane startowe (data/seed.php). */
function rm_seed(?string $key = null, mixed $default = null): mixed
{
    static $seed = null;
    $seed ??= require RM_DIR . '/data/seed.php';
    if ($key === null) return $seed;
    $node = $seed;
    foreach (explode('.', $key) as $part) {
        if (!is_array($node) || !array_key_exists($part, $node)) return $default;
        $node = $node[$part];
    }
    return $node;
}

function rm_e(?string $s): string { return esc_html((string)$s); }
function rm_tel(string $n): string { return 'tel:' . preg_replace('/\s+/', '', $n); }
function rm_url(string $path = ''): string { return home_url('/' . ltrim($path, '/')); }
function rm_asset(string $f): string { return RM_URI . '/assets/' . $f; }

/** Ustawienia z „Wygląd → Dostosuj → Rolmax” z wartościami domyślnymi z seed. */
function rm_opt(string $key): string
{
    $defaults = [
        'phone' => rm_seed('site.phone'), 'email' => rm_seed('site.email'), 'address' => rm_seed('site.address'),
        'shop' => rm_seed('site.shop'), 'facebook' => rm_seed('site.facebook'), 'instagram' => rm_seed('site.instagram'),
        'founded' => (string)rm_seed('site.founded'), 'jubilee' => (string)rm_seed('site.jubilee'),
        'ribbon_on' => '1', 'ribbon_motto' => 'Napędzani pasją od 1997',
        'm_phone1_label' => 'Sprzedaż', 'm_phone1' => '81 723 69 60', 'm_phone2_label' => 'Serwis', 'm_phone2' => '81 723 69 54', 'm_email' => 'rolmax@rolmax.net.pl',
        'c_phone1_label' => 'Części', 'c_phone1' => '81 721 67 85', 'c_phone2_label' => 'Kom.', 'c_phone2' => '662 032 735', 'c_email' => 'swidnik@rolmax-sklep.pl',
        'notice_on' => '1', 'notice_date' => '06.10', 'notice_title' => 'Soboty nieczynne do końca lutego',
        'notice_text' => 'W sezonie jesienno-zimowym sklepy stacjonarne działu części pracują od poniedziałku do piątku.',
        'sales1' => '606 363 398', 'sales2' => '606 815 418',
    ];
    $v = get_theme_mod('rm_' . $key, null);
    return (string)($v ?? ($defaults[$key] ?? ''));
}

/* ---------- Dział (Maszyny / Części) — kontekst nagłówka ---------- */
function rm_departments(): array
{
    return [
        'maszyny' => ['label' => 'Dział maszyn', 'short' => 'Maszyny', 'switch' => 'czesci', 'home' => 'pl/dzial-maszyn',
            'phones' => [[rm_opt('m_phone1_label'), rm_opt('m_phone1')], [rm_opt('m_phone2_label'), rm_opt('m_phone2')]], 'email' => rm_opt('m_email'),
            'cta' => ['Zapytaj o maszynę', rm_url('pl/kontakt/order')]],
        'czesci' => ['label' => 'Dział części', 'short' => 'Części', 'switch' => 'maszyny', 'home' => 'pl/dzial-czesci',
            'phones' => [[rm_opt('c_phone1_label'), rm_opt('c_phone1')], [rm_opt('c_phone2_label'), rm_opt('c_phone2')]], 'email' => rm_opt('c_email'),
            'cta' => ['Sklep online', rm_opt('shop')]],
    ];
}

/** Ustala dział bieżącej strony. Szablon może wymusić przez rm_set_dept(). */
function rm_set_dept(?string $d): void { $GLOBALS['rm_dept'] = $d; }
function rm_dept(): ?string
{
    if (array_key_exists('rm_dept', $GLOBALS)) return $GLOBALS['rm_dept'];
    if (is_singular('maszyna') || is_tax('kategoria-maszyn') || is_post_type_archive('maszyna')) return 'maszyny';
    if (is_page()) {
        $m = get_post_meta(get_queried_object_id(), '_rm_dzial', true);
        if (in_array($m, ['maszyny', 'czesci'], true)) return $m;
    }
    $c = $_COOKIE['rm_dzial'] ?? 'maszyny';
    return in_array($c, ['maszyny', 'czesci'], true) ? $c : 'maszyny';
}
function rm_remember_dept(string $d): void
{
    if (!headers_sent()) setcookie('rm_dzial', $d, ['expires' => time() + YEAR_IN_SECONDS, 'path' => COOKIEPATH ?: '/', 'samesite' => 'Lax']);
    $_COOKIE['rm_dzial'] = $d;
}

/** Strona po ścieżce (np. 'pl/uslugi/serwis') → URL; gdy brak strony, link i tak zgodny ze strukturą. */
function rm_page_url(string $path): string { return rm_url($path); }

/* ---------- Maszyny: kategorie i modele ---------- */
function rm_machine_terms(): array
{
    $terms = get_terms(['taxonomy' => 'kategoria-maszyn', 'hide_empty' => false, 'meta_key' => '_rm_order', 'orderby' => 'meta_value_num', 'order' => 'ASC']);
    return is_wp_error($terms) ? [] : $terms;
}
function rm_term_meta(WP_Term $t, string $k, string $d = ''): string { $v = get_term_meta($t->term_id, '_rm_' . $k, true); return $v !== '' ? (string)$v : $d; }
function rm_models(WP_Term $t): array
{
    return get_posts(['post_type' => 'maszyna', 'numberposts' => -1, 'orderby' => ['menu_order' => 'ASC', 'title' => 'ASC'], 'tax_query' => [['taxonomy' => 'kategoria-maszyn', 'terms' => $t->term_id]], 'no_found_rows' => true]);
}
/** Miniatura modelu: obrazek wyróżniający albo liniowy rysunek kategorii. */
function rm_model_thumb(WP_Post $p, string $icon, string $size = 'rm-card'): string
{
    if (has_post_thumbnail($p)) return get_the_post_thumbnail($p, $size, ['loading' => 'lazy', 'decoding' => 'async', 'alt' => '']);
    return '<svg class="mi" aria-hidden="true"><use href="#' . esc_attr($icon) . '"/></svg>';
}
function rm_series_word(int $n): string { return $n === 1 ? 'seria' : (($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20)) ? 'serie' : 'serii'); }

/* ---------- Oddziały ---------- */
function rm_branches(): array
{
    $out = [];
    foreach (get_posts(['post_type' => 'oddzial', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']) as $p) {
        $g = fn($k) => (string)get_post_meta($p->ID, '_rm_' . $k, true);
        $dept = function ($k) use ($g) {
            $hours = array_values(array_filter(array_map(function ($l) { $x = array_map('trim', explode('|', $l, 2)); return count($x) === 2 ? $x : null; }, preg_split('/\R/', $g($k . '_hours')))));
            $phones = array_values(array_filter(array_map('trim', preg_split('/\R/', $g($k . '_phones')))));
            return ($hours || $phones) ? [$hours, $phones, $g($k . '_email')] : null;
        };
        $out[] = ['n' => get_the_title($p), 's' => $g('label') ?: 'Oddział', 'a' => $g('address'), 'sales' => $dept('sales'), 'parts' => $dept('parts'), 'serv' => $dept('serv')];
    }
    return $out;
}

function rm_part(string $name, array $args = []): void { get_template_part('parts/' . $name, null, $args); }

/** Hierarchia stron do menu bocznego. */
function rm_sibling_pages(int $id): array
{
    $parent = wp_get_post_parent_id($id);
    return $parent ? get_pages(['parent' => $parent, 'sort_column' => 'menu_order,post_title']) : [];
}
