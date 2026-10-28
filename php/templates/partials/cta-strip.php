<?php $d = cfg("departments.$dept"); ?>
<section class="ctastrip">
  <div class="wrap">
    <div><span class="kicker">Masz pytania?</span><h3>Porozmawiaj <em class="s">z doradcą</em></h3></div>
    <div class="nums">
      <?php foreach ($d['phones'] as [$l, $n]): ?><a href="<?= tel($n) ?>"><small><?= e($l) ?></small><b><?= e($n) ?></b></a><?php endforeach; ?>
    </div>
    <a class="btn gold" href="<?= url("$dept/kontakt") ?>">Kontakt <span class="ar"></span></a>
  </div>
</section>
