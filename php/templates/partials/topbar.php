<?php $d = cfg("departments.$dept"); $other = cfg('departments.' . $d['switch']); ?>
<div class="topline"><div class="wrap">
  <div class="where">Jesteś w: <b><?= e($d['label']) ?></b>
    <a href="<?= url($d['switch']) ?>">Przejdź do: <?= e(mb_strtolower($other['short'])) ?></a>
  </div>
  <div class="tels">
    <?php foreach ($d['phones'] as [$lab, $num]): ?>
      <a href="<?= tel($num) ?>"><small><?= e($lab) ?></small> <?= e($num) ?></a>
    <?php endforeach; ?>
    <a href="mailto:<?= e($d['email']) ?>"><small>E-mail</small> <?= e($d['email']) ?></a>
  </div>
</div></div>
