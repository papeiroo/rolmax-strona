<?php /** @var string $line @var string $title @var string $text */ ?>
<section class="sec jub">
  <div class="wrap">
    <div class="num rv" aria-hidden="true">30<span><?= e($line) ?></span></div>
    <div class="rv">
      <span class="kicker">Jubileusz <?= cfg('site.jubilee') ?></span>
      <h2><?= $title ?></h2>
      <p class="l"><?= e($text) ?></p>
      <?php if (!empty($timeline)): ?>
      <div class="timeline">
        <div class="on"><b>1997</b><span>Założenie firmy w Świdniku</span></div>
        <div class="on"><b>New Holland</b><span>Autoryzowany dealer marki</span></div>
        <div class="on"><b>4 oddziały</b><span>Świdnik, Miączyn, Rudnik, Białka</span></div>
        <div><b>2027</b><span>30 lat Rolmax</span></div>
      </div>
      <?php endif; ?>
      <div class="count"><span class="lbl">Do jubileuszu</span><div><b data-cd="d">--</b><small>dni</small></div><div><b data-cd="h">--</b><small>godzin</small></div><div><b data-cd="m">--</b><small>minut</small></div></div>
    </div>
  </div>
</section>
