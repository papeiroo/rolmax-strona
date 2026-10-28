<?php
defined('ABSPATH') || exit;
get_header();
rm_part('page-hero', ['kicker' => 'Błąd 404', 'h1' => 'Tej strony <em class="s">nie ma</em>', 'lead' => 'Adres mógł się zmienić. Wróć do strony głównej albo wybierz pozycję z menu.', 'scene' => 'dusk', 'crumbs' => [['404', null]]]);
?>
<section class="sec light"><div class="wrap"><p><a class="btn dark" href="<?= esc_url(rm_url('pl')) ?>">Strona główna <span class="ar"></span></a></p></div></section>
<?php get_footer(); ?>
