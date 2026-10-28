<?php partial('page-hero', ['dept' => $dept, 'kicker' => 'Oferta New Holland', 'h1' => 'Oferta <em class="s">maszyn</em>', 'lead' => 'Dziewięć kategorii maszyn rolniczych i budowlanych New Holland. Wybierz kategorię, aby zobaczyć modele.', 'scene' => 'field', 'crumbs' => [['Oferta', null]]]); ?>
<section class="sec light">
  <div class="wrap">
    <div class="fleet">
      <?php $i = 0; foreach (cfg('machines') as $slug => [$code, $name, , $desc]): $i++; ?>
      <a class="unit" href="<?= url("$dept/oferta/$slug") ?>"><span class="idx"><?= sprintf('%02d', $i) ?> / 09</span><span class="code"><?= e($code) ?></span><h3><?= e($name) ?></h3><p><?= e($desc) ?></p><span class="go"><svg><use href="#i-ar"/></svg></span></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php partial('cta-strip', ['dept' => $dept]); ?>
