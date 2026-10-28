<?php
/**
 * Wygląd → Dostosuj → Rolmax: telefony, e-maile, wstążka 30-lecia, komunikat działu części.
 */
defined('ABSPATH') || exit;

add_action('customize_register', function (WP_Customize_Manager $c) {
    $c->add_panel('rm', ['title' => 'Rolmax', 'priority' => 20]);
    $sections = [
        'rm_firma' => ['Firma i kontakt', [
            'phone' => 'Telefon główny', 'email' => 'E-mail główny', 'address' => 'Adres siedziby',
            'sales1' => 'Sprzedaż maszyn — telefon 1', 'sales2' => 'Sprzedaż maszyn — telefon 2',
            'shop' => 'Adres sklepu internetowego', 'facebook' => 'Facebook (URL)', 'instagram' => 'Instagram (URL)']],
        'rm_maszyny' => ['Pasek działu maszyn', ['m_phone1_label' => 'Etykieta telefonu 1', 'm_phone1' => 'Telefon 1', 'm_phone2_label' => 'Etykieta telefonu 2', 'm_phone2' => 'Telefon 2', 'm_email' => 'E-mail']],
        'rm_czesci' => ['Pasek działu części', ['c_phone1_label' => 'Etykieta telefonu 1', 'c_phone1' => 'Telefon 1', 'c_phone2_label' => 'Etykieta telefonu 2', 'c_phone2' => 'Telefon 2', 'c_email' => 'E-mail']],
        'rm_jubileusz' => ['Wstążka 30-lecia', ['ribbon_on' => 'Pokazuj wstążkę (1 = tak, 0 = nie)', 'founded' => 'Rok założenia', 'jubilee' => 'Rok jubileuszu', 'ribbon_motto' => 'Motto w wstążce']],
        'rm_komunikat' => ['Komunikat działu części', ['notice_on' => 'Pokazuj (1 = tak, 0 = nie)', 'notice_date' => 'Data (np. 06.10)', 'notice_title' => 'Tytuł', 'notice_text' => 'Treść']],
    ];
    foreach ($sections as $id => [$title, $fields]) {
        $c->add_section($id, ['title' => $title, 'panel' => 'rm']);
        foreach ($fields as $k => $label) {
            $c->add_setting('rm_' . $k, ['default' => rm_opt($k), 'sanitize_callback' => str_contains($k, 'facebook') || str_contains($k, 'instagram') || $k === 'shop' ? 'esc_url_raw' : 'sanitize_text_field']);
            $c->add_control('rm_' . $k, ['label' => $label, 'section' => $id, 'type' => $k === 'notice_text' ? 'textarea' : 'text']);
        }
    }
});
