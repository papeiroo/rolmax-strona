<?php
/** $args: kicker, h1 (HTML), lead, scene, crumbs [[label, url|null], ...], photo (URL, opcjonalnie) */
$a = wp_parse_args($args, ['kicker' => '', 'h1' => '', 'lead' => '', 'scene' => 'field', 'crumbs' => [], 'photo' => '']);
$d = rm_dept();
?>
<section class="phero">
  <?php if ($a['photo']): ?><img class="hero-photo" src="<?= esc_url($a['photo']) ?>" alt="" decoding="async"><?php else: ?><canvas data-scene="<?= esc_attr($a['scene']) ?>"></canvas><?php endif; ?>
  <div class="wrap">
    <nav class="crumbs" aria-label="Okruszki">
      <a href="<?= esc_url(rm_url('pl')) ?>">Rolmax</a>
      <?php if ($d): ?><span>/</span><a href="<?= esc_url(rm_url(rm_departments()[$d]['home'])) ?>"><?= rm_e(rm_departments()[$d]['label']) ?></a><?php endif; ?>
      <?php foreach ($a['crumbs'] as [$lab, $href]): ?><span>/</span><?= $href ? '<a href="' . esc_url($href) . '">' . rm_e($lab) . '</a>' : '<b>' . rm_e($lab) . '</b>' ?><?php endforeach; ?>
    </nav>
    <?php if ($a['kicker']): ?><span class="kicker"><?= rm_e($a['kicker']) ?></span><?php endif; ?>
    <h1><?= wp_kses_post($a['h1']) ?></h1>
    <?php if ($a['lead']): ?><p class="lead"><?= rm_e($a['lead']) ?></p><?php endif; ?>
  </div>
</section>
