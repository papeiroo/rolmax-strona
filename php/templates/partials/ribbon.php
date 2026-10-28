<?php $years = cfg('site.jubilee') - cfg('site.founded'); ?>
<div class="ribbon" role="note">
  <div class="wrap">
    <div class="rm">
      <span class="medal"><?= $years ?></span>
      <span><b>Rolmax</b> · Jubileusz <?= cfg('site.founded') ?>–<?= cfg('site.jubilee') ?></span>
      <span class="serif">Napędzani pasją od <?= cfg('site.founded') ?></span>
    </div>
    <div class="cnt">Do roku jubileuszu: <span data-cd="d">--</span> dni <span data-cd="h">--</span> godz.</div>
  </div>
</div>
