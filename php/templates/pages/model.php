<?php /** @var array $cat @var array $model @var string $slug */ [$code, $cname, $sub, $cdesc] = $cat; [$mName, $mSlug] = $model; $icon = cfg("machine_icons.$slug"); ?>
<?php partial('page-hero', ['dept' => $dept, 'kicker' => $cname . ' · New Holland', 'h1' => e($mName), 'lead' => $cdesc, 'scene' => 'field', 'crumbs' => [['Oferta', 'maszyny/oferta'], [$cname, "maszyny/oferta/$slug"], [$mName, null]]]); ?>
<section class="sec light"><div class="wrap mdetail">
  <div class="mhero rv"><canvas data-scene="field"></canvas><?= model_thumb($mSlug, $icon) ?></div>
  <div class="prose rv">
    <p class="intro">Opis modelu <?= e($mName) ?> przeniesiemy 1:1 z obecnej karty na rolmax.net.pl, razem ze zdjęciami i sekcjami zalet.</p>
    <div class="mactions">
      <a class="btn gold" href="<?= url('pl/kontakt/order') ?>">Zapytanie ofertowe <span class="ar"></span></a>
      <a class="btn dark" href="https://agriculture.newholland.com/eu/pl-pl/o-nas/zakupy-i-uslugi/przed-zakupem/pobierz-broszure?series=<?= rawurlencode($mName) ?>">Pobierz broszurę <span class="ar"></span></a>
      <a class="btn dark" href="https://agriculture.newholland.com/eu/pl-pl/o-nas/zakupy-i-uslugi/zakup/konfigurator">Konfigurator <span class="ar"></span></a>
    </div>
    <h2>Inne <em class="s">w kategorii</em></h2>
    <ul class="siblings">
      <?php foreach (cfg("models.$slug", []) as [$n2, $s2]): if ($s2 === $mSlug) continue; ?>
      <li><a href="<?= url("maszyny/oferta/$slug/$s2") ?>"><?= e($n2) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div></section>
<?php partial('cta-strip', ['dept' => $dept]); ?>
