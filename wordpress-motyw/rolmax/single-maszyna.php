<?php
defined('ABSPATH') || exit;
rm_set_dept('maszyny');
get_header();
the_post();
$terms = get_the_terms(get_the_ID(), 'kategoria-maszyn');
$t = $terms && !is_wp_error($terms) ? $terms[0] : null;
$icon = $t ? rm_term_meta($t, 'icon', 'm-tractor') : 'm-tractor';
$crumbs = [['Oferta', get_post_type_archive_link('maszyna')]];
if ($t) $crumbs[] = [$t->name, get_term_link($t)];
$crumbs[] = [get_the_title(), null];
rm_part('page-hero', ['kicker' => ($t ? $t->name . ' · ' : '') . 'New Holland', 'h1' => esc_html(get_the_title()), 'lead' => has_excerpt() ? get_the_excerpt() : ($t ? wp_strip_all_tags($t->description) : ''), 'scene' => 'field', 'crumbs' => $crumbs]);
?>
<section class="sec light"><div class="wrap mdetail">
  <div class="mhero rv"><?php if (!has_post_thumbnail()): ?><canvas data-scene="field"></canvas><?php endif; ?><?= rm_model_thumb(get_post(), $icon, 'large') ?></div>
  <div class="prose rv">
    <?php the_content(); ?>
    <div class="mactions">
      <a class="btn gold" href="<?= esc_url(rm_url('pl/kontakt/order')) ?>">Zapytanie ofertowe <span class="ar"></span></a>
      <a class="btn dark" href="https://agriculture.newholland.com/eu/pl-pl/o-nas/zakupy-i-uslugi/przed-zakupem/pobierz-broszure?series=<?= rawurlencode(get_the_title()) ?>">Pobierz broszurę <span class="ar"></span></a>
      <a class="btn dark" href="https://agriculture.newholland.com/eu/pl-pl/o-nas/zakupy-i-uslugi/zakup/konfigurator">Konfigurator <span class="ar"></span></a>
    </div>
    <?php if ($t): $sib = array_filter(rm_models($t), fn($m) => $m->ID !== get_the_ID()); if ($sib): ?>
    <h2>Inne <em class="s">w kategorii</em></h2>
    <ul class="siblings"><?php foreach ($sib as $m): ?><li><a href="<?= esc_url(get_permalink($m)) ?>"><?= rm_e(get_the_title($m)) ?></a></li><?php endforeach; ?></ul>
    <?php endif; endif; ?>
  </div>
</div></section>
<?php rm_part('cta-strip'); get_footer(); ?>
