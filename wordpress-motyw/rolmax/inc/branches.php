<?php
/**
 * Oddziały: adres, godziny, telefony i e-maile działów — edycja w panelu „Oddziały”.
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    register_post_type('oddzial', [
        'labels' => ['name' => 'Oddziały', 'singular_name' => 'Oddział', 'add_new' => 'Dodaj oddział', 'add_new_item' => 'Dodaj oddział', 'edit_item' => 'Edytuj oddział', 'menu_name' => 'Oddziały'],
        'public' => false, 'show_ui' => true, 'menu_icon' => 'dashicons-location', 'menu_position' => 8,
        'supports' => ['title', 'page-attributes'],
    ]);
});

function rm_branch_depts(): array { return ['sales' => 'Sprzedaż maszyn', 'parts' => 'Dział części', 'serv' => 'Serwis']; }

add_action('add_meta_boxes_oddzial', function () {
    add_meta_box('rm_branch', 'Dane oddziału', function (WP_Post $p) {
        $g = fn($k) => esc_textarea((string)get_post_meta($p->ID, '_rm_' . $k, true));
        wp_nonce_field('rm_branch', 'rm_branch_nonce');
        echo '<style>.rm-b label{display:block;font-weight:600;margin:.8em 0 .3em}.rm-b input,.rm-b textarea{width:100%}.rm-b .col{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5em}.rm-b h4{margin:1.4em 0 0;border-top:1px solid #ddd;padding-top:1em}</style><div class="rm-b">';
        echo '<label for="rm_label">Opis (np. Siedziba, Oddział)</label><input id="rm_label" name="rm_label" value="' . $g('label') . '">';
        echo '<label for="rm_address">Adres (jedna linia: ulica, kod miasto)</label><input id="rm_address" name="rm_address" value="' . $g('address') . '">';
        echo '<div class="col">';
        foreach (rm_branch_depts() as $k => $label) {
            echo '<div><h4>' . esc_html($label) . '</h4>';
            echo '<label for="rm_' . $k . '_hours">Godziny — jedna linia: <code>Pon.–Pt. | 7:00–16:00</code></label><textarea id="rm_' . $k . '_hours" name="rm_' . $k . '_hours" rows="3">' . $g($k . '_hours') . '</textarea>';
            echo '<label for="rm_' . $k . '_phones">Telefony — jeden w linii</label><textarea id="rm_' . $k . '_phones" name="rm_' . $k . '_phones" rows="3">' . $g($k . '_phones') . '</textarea>';
            echo '<label for="rm_' . $k . '_email">E-mail</label><input id="rm_' . $k . '_email" name="rm_' . $k . '_email" value="' . $g($k . '_email') . '"></div>';
        }
        echo '</div><p class="description">Puste pola działu = dział nie występuje w tym oddziale. Kolejność oddziałów: pole „Kolejność” w Atrybutach.</p></div>';
    }, 'oddzial', 'normal', 'high');
});

add_action('save_post_oddzial', function ($id) {
    if (!isset($_POST['rm_branch_nonce']) || !wp_verify_nonce($_POST['rm_branch_nonce'], 'rm_branch') || !current_user_can('edit_post', $id)) return;
    update_post_meta($id, '_rm_label', sanitize_text_field(wp_unslash($_POST['rm_label'] ?? '')));
    update_post_meta($id, '_rm_address', sanitize_text_field(wp_unslash($_POST['rm_address'] ?? '')));
    foreach (array_keys(rm_branch_depts()) as $k) {
        update_post_meta($id, "_rm_{$k}_hours", sanitize_textarea_field(wp_unslash($_POST["rm_{$k}_hours"] ?? '')));
        update_post_meta($id, "_rm_{$k}_phones", sanitize_textarea_field(wp_unslash($_POST["rm_{$k}_phones"] ?? '')));
        update_post_meta($id, "_rm_{$k}_email", sanitize_email(wp_unslash($_POST["rm_{$k}_email"] ?? '')));
    }
});
