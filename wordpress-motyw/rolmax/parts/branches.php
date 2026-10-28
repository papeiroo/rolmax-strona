<?php
$dept = $args['dept'] ?? rm_dept();
$order = $dept === 'maszyny' ? [['sales', 'Sprzedaż maszyn'], ['serv', 'Serwis'], ['parts', 'Części']] : [['parts', 'Dział części'], ['serv', 'Serwis'], ['sales', 'Sprzedaż maszyn']];
$B = rm_branches();
if (!$B) return;
$uid = wp_unique_id('br');
?>
<div class="branches rv" data-tabs>
  <div class="btabs" role="tablist">
    <?php foreach ($B as $i => $b): ?>
    <button type="button" role="tab" id="<?= $uid ?>-t<?= $i ?>" aria-controls="<?= $uid ?>-p<?= $i ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>" tabindex="<?= $i === 0 ? '0' : '-1' ?>">
      <span class="n"><?= sprintf('%02d', $i + 1) ?></span><b><?= rm_e($b['n']) ?></b><small><?= rm_e($b['s']) ?></small>
    </button>
    <?php endforeach; ?>
  </div>
  <?php foreach ($B as $i => $b): ?>
  <div class="bpanel" role="tabpanel" id="<?= $uid ?>-p<?= $i ?>" aria-labelledby="<?= $uid ?>-t<?= $i ?>"<?= $i ? ' hidden' : '' ?>>
    <div class="top">
      <div><span class="kicker"><?= rm_e($b['s']) ?></span><h3 style="margin-top:.6rem"><?= rm_e($b['n']) ?></h3><div class="adr"><?= rm_e($b['a']) ?></div></div>
      <a class="btn" href="https://www.google.com/maps/search/?api=1&amp;query=<?= rawurlencode($b['a']) ?>">Wyznacz trasę <span class="ar"></span></a>
    </div>
    <div class="depts">
      <?php foreach ($order as [$k, $label]): if (empty($b[$k])) continue; [$hours, $phones, $mail] = $b[$k]; ?>
      <div class="dept">
        <h4><?= rm_e($label) ?></h4>
        <dl><?php foreach ($hours as [$dd, $h]): ?><dt><?= rm_e($dd) ?></dt><dd<?= $h === 'nieczynne' ? ' class="x"' : '' ?>><?= rm_e($h) ?></dd><?php endforeach; ?></dl>
        <?php foreach ($phones as $p): ?><a class="tel" href="<?= esc_attr(rm_tel($p)) ?>"><?= rm_e($p) ?></a><?php endforeach; ?>
        <?php if ($mail): ?><div class="ml"><?= rm_e($mail) ?></div><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
