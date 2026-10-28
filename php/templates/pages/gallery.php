<?php /** @var array $item */ [$slug, $title] = $item; ?>
<?php partial('page-hero', ['dept' => $dept, 'kicker' => 'Galeria', 'h1' => e($title), 'lead' => 'Zdjęcia z wydarzeń Rolmax.', 'scene' => 'field', 'crumbs' => [['Galeria', 'pl/galerie'], [$title, null]]]); ?>
<section class="sec light"><div class="wrap">
  <div class="ggrid rv"><?php for ($i = 0; $i < 8; $i++): ?><div class="gcell"><canvas data-scene="<?= ['field', 'dusk', 'rows', 'field'][$i % 4] ?>"></canvas></div><?php endfor; ?></div>
  <p style="margin-top:1.6rem;color:var(--ink-mute)">Zdjęcia z obecnej galerii zostaną przeniesione pod ten sam adres.</p>
</div></section>
