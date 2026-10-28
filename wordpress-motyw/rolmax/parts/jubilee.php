<?php $a = wp_parse_args($args, ['line' => 'lat razem z rolnikami', 'title' => 'Jedna droga, <em class="s">wspólny cel</em>', 'text' => '', 'timeline' => false]); ?>
<section class="sec jub">
  <div class="wrap">
    <div class="num rv" aria-hidden="true"><?= (int)rm_opt('jubilee') - (int)rm_opt('founded') ?><span><?= rm_e($a['line']) ?></span></div>
    <div class="rv">
      <span class="kicker">Jubileusz <?= rm_e(rm_opt('jubilee')) ?></span>
      <h2><?= wp_kses_post($a['title']) ?></h2>
      <p class="l"><?= rm_e($a['text']) ?></p>
      <?php if ($a['timeline']): ?>
      <div class="timeline">
        <div class="on"><b><?= rm_e(rm_opt('founded')) ?></b><span>Założenie firmy w Świdniku</span></div>
        <div class="on"><b>New Holland</b><span>Autoryzowany dealer marki</span></div>
        <div class="on"><b>4 oddziały</b><span>Świdnik, Miączyn, Rudnik, Białka</span></div>
        <div><b><?= rm_e(rm_opt('jubilee')) ?></b><span>30 lat Rolmax</span></div>
      </div>
      <?php endif; ?>
      <div class="count"><span class="lbl">Do jubileuszu</span><div><b data-cd="d">--</b><small>dni</small></div><div><b data-cd="h">--</b><small>godzin</small></div><div><b data-cd="m">--</b><small>minut</small></div></div>
    </div>
  </div>
</section>
