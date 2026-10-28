<?php /** @var array $item */ [$slug, $title, $where] = $item; ?>
<?php partial('page-hero', ['dept' => $dept, 'kicker' => 'Kariera · ' . $where, 'h1' => e($title), 'lead' => 'Dołącz do zespołu Rolmax.', 'scene' => 'workshop', 'crumbs' => [['Praca', 'pl/strony/praca'], [$title, null]]]); ?>
<section class="sec light"><div class="wrap">
  <article class="prose rv">
    <p class="intro"><?= e($title) ?> — <?= e($where) ?></p>
    <p>Opis stanowiska, wymagania i oferta zostaną przeniesione z obecnego ogłoszenia.</p>
    <a class="btn dark" href="<?= url('pl/kontakt') ?>">Aplikuj <span class="ar"></span></a>
  </article>
</div></section>
