<?php
/** @var string $dept */
$order = $dept === 'maszyny' ? [['sales', 'Sprzedaż maszyn'], ['serv', 'Serwis'], ['parts', 'Części']]
                             : [['parts', 'Dział części'], ['serv', 'Serwis'], ['sales', 'Sprzedaż maszyn']];
$B = cfg('branches');
?>
<div class="branches rv" data-tabs>
  <div class="btabs" role="tablist">
    <?php foreach ($B as $i => $b): ?>
    <button type="button" role="tab" id="bt-<?= $i ?>" aria-controls="bp-<?= $i ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>" tabindex="<?= $i === 0 ? '0' : '-1' ?>">
      <span class="n">0<?= $i + 1 ?></span><b><?= e($b['n']) ?></b><small><?= e($b['s']) ?></small>
    </button>
    <?php endforeach; ?>
  </div>
  <?php foreach ($B as $i => $b): ?>
  <div class="bpanel" role="tabpanel" id="bp-<?= $i ?>" aria-labelledby="bt-<?= $i ?>"<?= $i ? ' hidden' : '' ?>>
    <div class="top">
      <div><span class="kicker"><?= e($b['s']) ?></span><h3 style="margin-top:.6rem"><?= e($b['n']) ?></h3><div class="adr"><?= e($b['a']) ?></div></div>
      <a class="btn" href="https://www.google.com/maps/search/?api=1&amp;query=<?= rawurlencode($b['a']) ?>">Wyznacz trasę <span class="ar"></span></a>
    </div>
    <div class="depts">
      <?php foreach ($order as [$k, $label]): if (empty($b[$k])) continue; [$hours, $phones, $mail] = $b[$k]; ?>
      <div class="dept">
        <h4><?= e($label) ?></h4>
        <dl><?php foreach ($hours as [$d, $h]): ?><dt><?= e($d) ?></dt><dd<?= $h === 'nieczynne' ? ' class="x"' : '' ?>><?= e($h) ?></dd><?php endforeach; ?></dl>
        <?php foreach ($phones as $p): ?><a class="tel" href="<?= tel($p) ?>"><?= e($p) ?></a><?php endforeach; ?>
        <div class="ml"><?= e($mail) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
