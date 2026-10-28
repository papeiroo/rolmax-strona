<?php /** @var array $cat @var string $slug */ [$code, $name, $sub, $desc] = $cat; ?>
<?php partial('page-hero', ['dept' => $dept, 'kicker' => $sub, 'h1' => e($name), 'lead' => $desc, 'scene' => 'field', 'crumbs' => [['Oferta', "$dept/oferta"], [$name, null]]]); ?>
<section class="sec light">
  <div class="wrap layout2">
    <aside class="subnav rv">
      <span class="kicker">Kategorie</span>
      <ul>
        <?php foreach (cfg('machines') as $s => [$c, $n]): ?>
        <li><a href="<?= url("$dept/oferta/$s") ?>"<?= $s === $slug ? ' aria-current="page"' : '' ?>><span><?= e($c) ?></span><?= e($n) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </aside>
    <div class="rv">
      <div class="models">
        <?php $icon = cfg("machine_icons.$slug"); foreach (cfg("models.$slug", []) as [$mName, $mSlug]): ?>
        <a class="model" id="<?= e($mSlug) ?>" href="<?= url("maszyny/oferta/$slug/$mSlug") ?>">
          <div class="mvis"><canvas data-scene="field"></canvas><?= model_thumb($mSlug, $icon) ?></div>
          <div class="mbd"><small><?= e($name) ?></small><h3><?= e($mName) ?></h3><p>Zdjęcie, opis i dane techniczne przeniesiemy z obecnej karty modelu na rolmax.net.pl.</p>
            <div class="mfoot"><span>New Holland</span><span class="go">Zobacz model →</span></div></div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php partial('cta-strip', ['dept' => $dept]); ?>
