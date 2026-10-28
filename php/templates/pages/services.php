<?php partial('page-hero', ['dept' => $dept, 'kicker' => 'Usługi Rolmax', 'h1' => 'Usługi', 'lead' => 'Części, serwis, finansowanie, likwidacja szkód i rolnictwo precyzyjne. Wszystko w jednym miejscu, od 1997 roku.', 'scene' => 'workshop', 'crumbs' => [['Usługi', null]]]); ?>
<section class="sec light"><div class="wrap">
  <div class="jobs">
    <?php $i = 0; foreach (SERVICE_MAP as $seg => $key): [$t, $k, $lead] = cfg("pages.$key"); $i++; ?>
    <a class="job" href="<?= url("pl/uslugi/$seg") ?>"><span class="n"><?= sprintf('%02d', $i) ?></span><h3><?= e($t) ?> <em class="s">— <?= e($lead) ?></em></h3><span class="go"><svg><use href="#i-ar"/></svg></span></a>
    <?php endforeach; ?>
  </div>
</div></section>
<?php partial('cta-strip', ['dept' => $dept]); ?>
