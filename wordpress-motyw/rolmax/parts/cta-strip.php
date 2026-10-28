<?php $d = rm_departments()[rm_dept() ?: 'maszyny']; ?>
<section class="ctastrip">
  <div class="wrap">
    <div><span class="kicker">Masz pytania?</span><h3>Porozmawiaj <em class="s">z doradcą</em></h3></div>
    <div class="nums">
      <?php foreach ($d['phones'] as [$l, $n]): if (!$n) continue; ?><a href="<?= esc_attr(rm_tel($n)) ?>"><small><?= rm_e($l) ?></small><b><?= rm_e($n) ?></b></a><?php endforeach; ?>
    </div>
    <a class="btn gold" href="<?= esc_url(rm_url('pl/kontakt')) ?>">Kontakt <span class="ar"></span></a>
  </div>
</section>
