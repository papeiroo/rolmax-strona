<?php $y = (int)rm_opt('jubilee') - (int)rm_opt('founded'); ?>
<div class="ribbon" role="note">
  <div class="wrap">
    <div class="rm">
      <span class="medal"><?= (int)$y ?></span>
      <span><b>Rolmax</b> · Jubileusz <?= rm_e(rm_opt('founded')) ?>–<?= rm_e(rm_opt('jubilee')) ?></span>
      <span class="serif"><?= rm_e(rm_opt('ribbon_motto')) ?></span>
    </div>
    <div class="cnt" data-jubilee="<?= esc_attr(rm_opt('jubilee')) ?>">Do roku jubileuszu: <span data-cd="d">--</span> dni <span data-cd="h">--</span> godz.</div>
  </div>
</div>
