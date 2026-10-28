<?php
/**
 * Import startowej struktury przy pierwszej aktywacji motywu:
 * strony z dotychczasowymi adresami, kategorie i modele maszyn, oddziały, archiwum aktualności, galerie, oferty pracy.
 * Uruchamia się raz (opcja rolmax_imported). Ponownie: Narzędzia → Rolmax: import startowy, albo `wp rolmax import`.
 * Istniejące elementy (po adresie) nie są nadpisywane.
 */
defined('ABSPATH') || exit;

function rm_block(string $text): string { return "<!-- wp:paragraph -->\n<p>" . esc_html($text) . "</p>\n<!-- /wp:paragraph -->"; }

function rm_upsert_page(string $path, string $title, array $o = []): int
{
    if ($p = get_page_by_path($path, OBJECT, 'page')) return $p->ID;
    $parts = explode('/', $path);
    $slug = array_pop($parts);
    $parent = $parts ? (get_page_by_path(implode('/', $parts), OBJECT, 'page')->ID ?? 0) : 0;
    $id = wp_insert_post(['post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $slug, 'post_parent' => $parent,
        'menu_order' => $o['order'] ?? 0, 'post_content' => $o['content'] ?? '', 'post_excerpt' => $o['excerpt'] ?? ''], true);
    if (is_wp_error($id)) return 0;
    if (!empty($o['template'])) update_post_meta($id, '_wp_page_template', 'page-templates/' . $o['template'] . '.php');
    if (!empty($o['dzial'])) update_post_meta($id, '_rm_dzial', $o['dzial']);
    if (!empty($o['kicker'])) update_post_meta($id, '_rm_kicker', $o['kicker']);
    return $id;
}

function rm_upsert_post(string $type, string $slug, array $a): int
{
    $ex = get_posts(['post_type' => $type, 'name' => $slug, 'post_status' => 'any', 'numberposts' => 1, 'fields' => 'ids']);
    if ($ex) return $ex[0];
    $id = wp_insert_post($a + ['post_type' => $type, 'post_status' => 'publish', 'post_name' => $slug], true);
    return is_wp_error($id) ? 0 : $id;
}

function rm_import(): array
{
    @set_time_limit(300);
    $n = ['strony' => 0, 'maszyny' => 0, 'aktualnosci' => 0, 'galerie' => 0, 'praca' => 0, 'oddzialy' => 0];

    // Adresy jak na dotychczasowej stronie
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/pl/aktualnosci/%postname%');
    $wp_rewrite->set_category_base('pl/aktualnosci/kategoria');
    $wp_rewrite->set_tag_base('pl/aktualnosci/tag');
    update_option('show_on_front', 'posts');
    update_option('posts_per_page', 12);
    update_option('blogname', 'Rolmax');
    update_option('blogdescription', 'Autoryzowany Przedstawiciel New Holland');
    update_option('default_comment_status', 'closed');

    // Usuń przykładowe treści WordPressa
    foreach (['hello-world' => 'post', 'sample-page' => 'page', 'przykladowa-strona' => 'page', 'witaj-swiecie' => 'post'] as $s => $t) {
        foreach (get_posts(['post_type' => $t, 'name' => $s, 'numberposts' => 1, 'post_status' => 'any']) as $p) wp_delete_post($p->ID, true);
    }

    // Strony (struktura adresów 1:1)
    $pg = rm_seed('pages');
    $pages = [
        ['pl', 'Rolmax', ['template' => 'tpl-intro']],
        ['pl/dzial-maszyn', 'Dział maszyn', ['template' => 'tpl-dzial-maszyn', 'dzial' => 'maszyny', 'order' => 1]],
        ['pl/dzial-czesci', 'Dział części', ['template' => 'tpl-dzial-czesci', 'dzial' => 'czesci', 'order' => 2]],
        ['pl/uslugi', 'Usługi', ['template' => 'tpl-uslugi', 'order' => 3, 'kicker' => 'Usługi Rolmax', 'excerpt' => 'Części, serwis, finansowanie, likwidacja szkód i rolnictwo precyzyjne.']],
        ['pl/uslugi/czesci', 'Części', ['dzial' => 'czesci', 'order' => 1, 'kicker' => $pg['czesci-zamowienia'][1], 'excerpt' => $pg['czesci-zamowienia'][2]]],
        ['pl/uslugi/serwis', 'Serwis', ['dzial' => 'czesci', 'order' => 2, 'kicker' => $pg['serwis'][1], 'excerpt' => $pg['serwis'][2]]],
        ['pl/uslugi/finansowanie', 'Finansowanie', ['dzial' => 'maszyny', 'order' => 3, 'kicker' => $pg['finansowanie'][1], 'excerpt' => $pg['finansowanie'][2]]],
        ['pl/uslugi/likwidacja-szkod', 'Likwidacja szkód', ['dzial' => 'czesci', 'order' => 4, 'kicker' => $pg['likwidacja-szkod'][1], 'excerpt' => $pg['likwidacja-szkod'][2]]],
        ['pl/uslugi/rolnictwo-precyzyjne', 'Rolnictwo precyzyjne', ['dzial' => 'maszyny', 'order' => 5, 'kicker' => $pg['rolnictwo-precyzyjne'][1], 'excerpt' => $pg['rolnictwo-precyzyjne'][2]]],
        ['pl/aktualnosci', 'Aktualności', ['template' => 'tpl-aktualnosci', 'order' => 4, 'kicker' => 'Z życia Rolmax', 'excerpt' => 'Ogłoszenia, promocje i nowości z naszych oddziałów.']],
        ['pl/promocje', 'Promocje', ['template' => 'tpl-promocje', 'dzial' => 'czesci', 'order' => 5, 'kicker' => 'Akcje miesiąca', 'excerpt' => 'Ceny promocyjne do końca miesiąca lub do wyczerpania zapasów.']],
        ['pl/strony', 'Firma', ['order' => 6]],
        ['pl/strony/o-nas', 'O nas', ['order' => 1, 'kicker' => 'Od 1997', 'excerpt' => 'Autoryzowany przedstawiciel New Holland na Lubelszczyźnie.']],
        ['pl/kontakt', 'Kontakt', ['template' => 'tpl-kontakt', 'order' => 7, 'kicker' => 'Cztery oddziały', 'excerpt' => 'Świdnik, Miączyn, Rudnik i Białka. Wybierz oddział i dział.']],
        ['pl/kontakt/order', 'Zapytanie o maszynę', ['template' => 'tpl-kontakt', 'dzial' => 'maszyny', 'order' => 1, 'kicker' => 'Kontakt', 'excerpt' => 'Doradca z najbliższego oddziału oddzwoni z ofertą i warunkami finansowania.']],
        ['pl/kontakt/support', 'Zgłoszenie serwisowe', ['template' => 'tpl-kontakt', 'dzial' => 'czesci', 'order' => 2, 'kicker' => 'Kontakt', 'excerpt' => 'Opisz usterkę i podaj numer seryjny maszyny — serwis oddzwoni.']],
    ];
    foreach ($pages as [$path, $title, $o]) {
        $o['content'] ??= ($o['excerpt'] ?? '') !== '' ? rm_block($o['excerpt']) . "\n\n" . rm_block('Treść tej strony przenieś z dotychczasowej strony rolmax.net.pl (ten sam adres).') : '';
        if (rm_upsert_page($path, $title, $o)) $n['strony']++;
    }

    // Kategorie i modele maszyn
    $i = 0;
    foreach (rm_seed('machines') as $slug => [$code, $name, $sub, $desc]) {
        $t = term_exists($slug, 'kategoria-maszyn') ?: wp_insert_term($name, 'kategoria-maszyn', ['slug' => $slug, 'description' => $desc]);
        if (is_wp_error($t)) continue;
        $tid = (int)$t['term_id'];
        foreach (['code' => $code, 'sub' => $sub, 'icon' => rm_seed("machine_icons.$slug"), 'order' => (string)++$i] as $k => $v) if (get_term_meta($tid, '_rm_' . $k, true) === '') update_term_meta($tid, '_rm_' . $k, $v);
        foreach (rm_seed("models.$slug", []) as $j => [$mName, $mSlug]) {
            $id = rm_upsert_post('maszyna', $mSlug, ['post_title' => $mName, 'menu_order' => $j, 'post_content' => rm_block("Opis modelu $mName — przenieś z obecnej karty na rolmax.net.pl, dodaj zdjęcie jako obrazek wyróżniający.")]);
            if ($id) { wp_set_object_terms($id, $tid, 'kategoria-maszyn'); $n['maszyny']++; }
        }
    }

    // Aktualności (archiwum z dotychczasowej strony)
    $promo = term_exists('promocje', 'category') ?: wp_insert_term('Promocje', 'category', ['slug' => 'promocje']);
    $def = get_term((int)get_option('default_category'), 'category');
    if ($def && !is_wp_error($def) && $def->slug !== 'aktualnosci') wp_update_term($def->term_id, 'category', ['name' => 'Aktualności', 'slug' => 'aktualnosci']);
    foreach (require RM_DIR . '/data/news.php' as [$slug, $date, $title]) {
        $d = DateTime::createFromFormat('d.m.Y H:i', "$date 09:00");
        $id = rm_upsert_post('post', $slug, ['post_title' => $title, 'post_date' => $d ? $d->format('Y-m-d H:i:s') : current_time('mysql'),
            'post_content' => rm_block('Treść i zdjęcia tego wpisu przenieś z dotychczasowej strony — adres pozostaje ten sam.')]);
        if (!$id) continue;
        $n['aktualnosci']++;
        if (preg_match('/promoc|rabat|taniej|okazj|wyprzeda|finansowanie/i', $slug) && !is_wp_error($promo)) wp_set_post_categories($id, [(int)$promo['term_id']], true);
    }

    foreach (require RM_DIR . '/data/galleries.php' as $k => [$slug, $title]) {
        if (rm_upsert_post('galeria', $slug, ['post_title' => $title, 'menu_order' => $k, 'post_date' => date('Y-m-d H:i:s', time() - $k * 60), 'post_content' => rm_block('Dodaj zdjęcia blokiem „Galeria”.')])) $n['galerie']++;
    }
    foreach (require RM_DIR . '/data/jobs.php' as $k => [$slug, $title, $where]) {
        if (rm_upsert_post('praca', $slug, ['post_title' => $title, 'post_excerpt' => $where, 'menu_order' => $k, 'post_content' => rm_block('Opis stanowiska, wymagania i oferta — przenieś z obecnego ogłoszenia.')])) $n['praca']++;
    }

    // Oddziały
    foreach (rm_seed('branches') as $k => $b) {
        if (get_posts(['post_type' => 'oddzial', 'title' => $b['n'], 'numberposts' => 1, 'post_status' => 'any'])) continue;
        $id = wp_insert_post(['post_type' => 'oddzial', 'post_status' => 'publish', 'post_title' => $b['n'], 'menu_order' => $k]);
        if (!$id || is_wp_error($id)) continue;
        update_post_meta($id, '_rm_label', $b['s']);
        update_post_meta($id, '_rm_address', $b['a']);
        foreach (['sales', 'parts', 'serv'] as $d) {
            if (empty($b[$d])) continue;
            [$hours, $phones, $mail] = $b[$d];
            update_post_meta($id, "_rm_{$d}_hours", implode("\n", array_map(fn($h) => $h[0] . ' | ' . $h[1], $hours)));
            update_post_meta($id, "_rm_{$d}_phones", implode("\n", $phones));
            update_post_meta($id, "_rm_{$d}_email", $mail);
        }
        $n['oddzialy']++;
    }

    update_option('rolmax_imported', RM_VER);
    flush_rewrite_rules(false);
    return $n;
}

add_action('after_switch_theme', function () {
    if (!get_option('rolmax_imported')) { rm_import(); }
    flush_rewrite_rules(false);
});

/* Narzędzia → Rolmax: import startowy */
add_action('admin_menu', function () {
    add_management_page('Rolmax: import startowy', 'Rolmax: import startowy', 'manage_options', 'rolmax-import', function () {
        echo '<div class="wrap"><h1>Rolmax: import startowy</h1>';
        if (isset($_POST['rm_go']) && check_admin_referer('rm_import')) {
            $n = rm_import();
            echo '<div class="notice notice-success"><p>Gotowe. Dodano/sprawdzono: ' . esc_html(implode(', ', array_map(fn($k, $v) => "$k: $v", array_keys($n), $n))) . '.</p></div>';
        }
        echo '<p>Tworzy brakujące strony, maszyny, oddziały, aktualności, galerie i oferty pracy z adresami dotychczasowej strony. Istniejących treści nie nadpisuje.</p>';
        echo '<form method="post">';
        wp_nonce_field('rm_import');
        submit_button('Uruchom import', 'primary', 'rm_go');
        echo '</form></div>';
    });
});

if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('rolmax import', function () { $n = rm_import(); WP_CLI::success(wp_json_encode($n)); });
}
