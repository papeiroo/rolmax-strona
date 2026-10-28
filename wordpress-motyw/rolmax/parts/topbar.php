<?php $deps = rm_departments(); $d = $deps[$args['dept']]; $o = $deps[$d['switch']]; ?>
<div class="topline"><div class="wrap">
  <div class="where">Jesteś w: <b><?= rm_e($d['label']) ?></b>
    <a href="<?= esc_url(rm_url($o['home'])) ?>">Przejdź do: <?= rm_e(mb_strtolower($o['short'])) ?></a>
  </div>
  <div class="tels">
    <?php foreach ($d['phones'] as [$lab, $num]): if (!$num) continue; ?>
      <a href="<?= esc_attr(rm_tel($num)) ?>"><small><?= rm_e($lab) ?></small> <?= rm_e($num) ?></a>
    <?php endforeach; ?>
    <a href="mailto:<?= esc_attr($d['email']) ?>"><small>E-mail</small> <?= rm_e($d['email']) ?></a>
  </div>
</div></div>
