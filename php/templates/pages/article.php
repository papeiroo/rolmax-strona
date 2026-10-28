<?php /** @var array $item */ [$slug, $date, $title] = $item; ?>
<?php partial('page-hero', ['dept' => $dept, 'kicker' => $date, 'h1' => e($title), 'lead' => 'Aktualności Rolmax', 'scene' => 'dusk', 'crumbs' => [['Aktualności', 'pl/aktualnosci'], [$title, null]]]); ?>
<section class="sec light"><div class="wrap layout2">
  <aside class="subnav rv">
    <span class="kicker">Najnowsze</span>
    <ul><?php foreach (array_slice(data('news'), 0, 8) as [$s2, $d2, $t2]): ?><li><a href="<?= url("pl/aktualnosci/$s2") ?>"<?= $s2 === $slug ? ' aria-current="page"' : '' ?>><span>›</span><?= e($t2) ?></a></li><?php endforeach; ?></ul>
  </aside>
  <article class="prose rv">
    <p class="intro"><?= e($title) ?></p>
    <p>Treść i zdjęcia tego wpisu zostaną przeniesione z obecnej strony bez zmiany adresu, więc wszystkie linki z Google i Facebooka nadal będą działać.</p>
    <a class="btn dark" href="<?= url('pl/aktualnosci') ?>">Wszystkie aktualności <span class="ar"></span></a>
  </article>
</div></section>
