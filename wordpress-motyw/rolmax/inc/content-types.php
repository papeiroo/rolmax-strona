<?php
/**
 * Typy treści: Maszyny (z kategoriami), Galerie, Oferty pracy.
 * Adresy ustawione tak, by pokrywały się z dotychczasową stroną rolmax.net.pl.
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    register_taxonomy('kategoria-maszyn', ['maszyna'], [
        'labels' => ['name' => 'Kategorie maszyn', 'singular_name' => 'Kategoria maszyn', 'add_new_item' => 'Dodaj kategorię', 'edit_item' => 'Edytuj kategorię', 'menu_name' => 'Kategorie'],
        'public' => true, 'hierarchical' => true, 'show_admin_column' => true, 'show_in_rest' => true,
        'rewrite' => ['slug' => 'pl/maszyny', 'with_front' => false],
    ]);

    register_post_type('maszyna', [
        'labels' => ['name' => 'Maszyny', 'singular_name' => 'Maszyna', 'add_new' => 'Dodaj model', 'add_new_item' => 'Dodaj model maszyny', 'edit_item' => 'Edytuj model', 'all_items' => 'Wszystkie modele', 'menu_name' => 'Maszyny'],
        'public' => true, 'menu_icon' => 'dashicons-car', 'menu_position' => 5, 'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'has_archive' => 'pl/maszyny',
        'rewrite' => ['slug' => 'pl/maszyny/%kategoria-maszyn%', 'with_front' => false],
    ]);

    register_post_type('galeria', [
        'labels' => ['name' => 'Galerie', 'singular_name' => 'Galeria', 'add_new' => 'Dodaj galerię', 'add_new_item' => 'Dodaj galerię', 'edit_item' => 'Edytuj galerię', 'menu_name' => 'Galerie'],
        'public' => true, 'menu_icon' => 'dashicons-format-gallery', 'menu_position' => 6, 'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => 'pl/galerie', 'rewrite' => ['slug' => 'pl/galerie', 'with_front' => false],
    ]);

    register_post_type('praca', [
        'labels' => ['name' => 'Oferty pracy', 'singular_name' => 'Oferta pracy', 'add_new' => 'Dodaj ofertę', 'add_new_item' => 'Dodaj ofertę pracy', 'edit_item' => 'Edytuj ofertę', 'menu_name' => 'Praca'],
        'public' => true, 'menu_icon' => 'dashicons-businessperson', 'menu_position' => 7, 'show_in_rest' => true,
        'supports' => ['title', 'editor', 'excerpt'],
        'has_archive' => 'pl/strony/praca', 'rewrite' => ['slug' => 'pl/strony/praca', 'with_front' => false],
    ]);

    add_rewrite_tag('%kategoria-maszyn%', '([^/]+)');
    // Model: /pl/maszyny/{kategoria}/{model} — przed regułą kategorii
    add_rewrite_rule('^pl/maszyny/([^/]+)/([^/]+)/?$', 'index.php?kategoria-maszyn=$matches[1]&maszyna=$matches[2]&post_type=maszyna', 'top');
}, 5);

/* Link modelu z kategorią w adresie */
add_filter('post_type_link', function ($link, $post) {
    if ($post->post_type !== 'maszyna') return $link;
    $terms = get_the_terms($post, 'kategoria-maszyn');
    $slug = ($terms && !is_wp_error($terms)) ? $terms[0]->slug : 'inne';
    return str_replace('%kategoria-maszyn%', $slug, $link);
}, 10, 2);

/* Kolumna „Kolejność” i sortowanie modeli w panelu */
add_action('pre_get_posts', function (WP_Query $q) {
    if (is_admin() && $q->is_main_query() && $q->get('post_type') === 'maszyna' && !$q->get('orderby')) {
        $q->set('orderby', ['menu_order' => 'ASC', 'title' => 'ASC']);
    }
});

/* ---------- Pola kategorii maszyn: kod, podpis, rysunek, kolejność ---------- */
function rm_term_fields(): array
{
    return [
        'code'  => ['Kod w menu', 'Np. T, CX, BB — duża litera przy nazwie w wstążce.'],
        'sub'   => ['Podpis w menu', 'Krótki opis pod nazwą, np. „Serie T4 – T7 i większe”.'],
        'icon'  => ['Rysunek', 'm-tractor, m-tele, m-combine, m-mower, m-baler, m-forage, m-plough, m-cult, m-constr'],
        'order' => ['Kolejność', 'Liczba — mniejsza wyżej w menu.'],
    ];
}
add_action('kategoria-maszyn_edit_form_fields', function (WP_Term $t) {
    foreach (rm_term_fields() as $k => [$label, $help]) {
        printf('<tr class="form-field"><th><label for="rm_%1$s">%2$s</label></th><td><input id="rm_%1$s" name="rm_%1$s" value="%3$s"><p class="description">%4$s</p></td></tr>',
            esc_attr($k), esc_html($label), esc_attr(get_term_meta($t->term_id, '_rm_' . $k, true)), esc_html($help));
    }
    wp_nonce_field('rm_term', 'rm_term_nonce');
});
add_action('kategoria-maszyn_add_form_fields', function () {
    foreach (rm_term_fields() as $k => [$label, $help]) {
        printf('<div class="form-field"><label for="rm_%1$s">%2$s</label><input id="rm_%1$s" name="rm_%1$s"><p>%3$s</p></div>', esc_attr($k), esc_html($label), esc_html($help));
    }
    wp_nonce_field('rm_term', 'rm_term_nonce');
});
$rm_save_term = function ($term_id) {
    if (!isset($_POST['rm_term_nonce']) || !wp_verify_nonce($_POST['rm_term_nonce'], 'rm_term') || !current_user_can('manage_categories')) return;
    foreach (array_keys(rm_term_fields()) as $k) {
        if (isset($_POST['rm_' . $k])) update_term_meta($term_id, '_rm_' . $k, sanitize_text_field(wp_unslash($_POST['rm_' . $k])));
    }
};
add_action('edited_kategoria-maszyn', $rm_save_term);
add_action('created_kategoria-maszyn', $rm_save_term);

/* ---------- Pole „Dział” przy stronach (kontekst nagłówka) ---------- */
add_action('add_meta_boxes_page', function () {
    add_meta_box('rm_dzial', 'Rolmax — dział', function (WP_Post $p) {
        $v = get_post_meta($p->ID, '_rm_dzial', true);
        wp_nonce_field('rm_dzial', 'rm_dzial_nonce');
        echo '<p><label for="rm_dzial_sel">Nagłówek i menu strony:</label></p><select id="rm_dzial_sel" name="rm_dzial" style="width:100%">';
        foreach (['' => 'Zapamiętany dział odwiedzającego', 'maszyny' => 'Dział maszyn', 'czesci' => 'Dział części'] as $k => $l) printf('<option value="%s"%s>%s</option>', esc_attr($k), selected($v, $k, false), esc_html($l));
        echo '</select><p><label for="rm_kicker">Nadtytuł (mały złoty napis):</label><input id="rm_kicker" name="rm_kicker" style="width:100%" value="' . esc_attr(get_post_meta($p->ID, '_rm_kicker', true)) . '"></p>';
    }, 'page', 'side');
});
add_action('save_post_page', function ($id) {
    if (!isset($_POST['rm_dzial_nonce']) || !wp_verify_nonce($_POST['rm_dzial_nonce'], 'rm_dzial') || !current_user_can('edit_page', $id)) return;
    update_post_meta($id, '_rm_dzial', in_array($_POST['rm_dzial'] ?? '', ['maszyny', 'czesci'], true) ? $_POST['rm_dzial'] : '');
    update_post_meta($id, '_rm_kicker', sanitize_text_field(wp_unslash($_POST['rm_kicker'] ?? '')));
});
