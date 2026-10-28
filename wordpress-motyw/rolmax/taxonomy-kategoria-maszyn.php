<?php
defined('ABSPATH') || exit;
rm_set_dept('maszyny');
get_header();
$t = get_queried_object();
$icon = rm_term_meta($t, 'icon', 'm-tractor');
rm_part('page-hero', ['kicker' => rm_term_meta($t, 'sub'), 'h1' => esc_html($t->name), 'lead' => wp_strip_all_tags($t->description), 'scene' => 'field', 'crumbs' => [['Oferta', get_post_type_archive_link('maszyna')], [$t->name, null]]]);
?>
<section class="sec light">
  <div class="wrap layout2">
    <aside class="subnav rv">
      <span class="kicker">Kategorie</span>
      <ul><?php foreach (rm_machine_terms() as $x): ?><li><a href="<?= esc_url(get_term_link($x)) ?>"<?= $x->term_id === $t->term_id ? ' aria-current="page"' : '' ?>><span><?= rm_e(rm_term_meta($x, 'code')) ?></span><?= rm_e($x->name) ?></a></li><?php endforeach; ?></ul>
    </aside>
    <div class="rv">
      <div class="models">
        <?php foreach (rm_models($t) as $m): ?>
        <a class="model" id="<?= esc_attr($m->post_name) ?>" href="<?= esc_url(get_permalink($m)) ?>">
          <div class="mvis"><?php if (!has_post_thumbnail($m)): ?><canvas data-scene="field"></canvas><?php endif; ?><?= rm_model_thumb($m, $icon) ?></div>
          <div class="mbd"><small><?= rm_e($t->name) ?></small><h3><?= rm_e(get_the_title($m)) ?></h3><?php if ($m->post_excerpt): ?><p><?= rm_e($m->post_excerpt) ?></p><?php endif; ?>
            <div class="mfoot"><span>New Holland</span><span class="go">Zobacz model →</span></div></div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php rm_part('cta-strip'); get_footer(); ?>
