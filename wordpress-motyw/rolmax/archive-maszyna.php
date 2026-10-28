<?php
defined('ABSPATH') || exit;
rm_set_dept('maszyny');
get_header();
rm_part('page-hero', ['kicker' => 'Oferta New Holland', 'h1' => 'Oferta <em class="s">maszyn</em>', 'lead' => 'Kategorie maszyn rolniczych i budowlanych New Holland. Wybierz kategorię, aby zobaczyć modele.', 'scene' => 'field', 'photo' => rm_asset('img/maszyny.jpg'), 'crumbs' => [['Oferta', null]]]);
?>
<section class="sec light"><div class="wrap"><?php get_template_part('parts/fleet', null, ['terms' => rm_machine_terms()]); ?></div></section>
<?php rm_part('cta-strip'); get_footer(); ?>
