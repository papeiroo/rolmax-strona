<?php /** @var array $page_ @var string $slug @var int $page */ [$t, $k, $lead, $scene] = $page_; ?>
<?php partial('page-hero', ['dept' => $dept, 'kicker' => $k, 'h1' => e($t), 'lead' => $lead, 'scene' => $scene, 'crumbs' => [[$t, null]]]); ?>

<?php if ($slug === 'kontakt'): ?>
<section class="sec"><div class="wrap">
  <div class="cnav rv">
    <a href="<?= url('pl/kontakt') ?>"<?= empty($variant) ? ' aria-current="page"' : '' ?>>Oddziały i telefony</a>
    <a href="<?= url('pl/kontakt/order') ?>"<?= ($variant ?? '') === 'order' ? ' aria-current="page"' : '' ?>>Zapytanie o maszynę</a>
    <a href="<?= url('pl/kontakt/support') ?>"<?= ($variant ?? '') === 'support' ? ' aria-current="page"' : '' ?>>Zgłoszenie serwisowe</a>
  </div>
  <?php if (!empty($variant)): ?>
  <form class="lead rv" onsubmit="return false" style="margin-top:2.4rem">
    <label class="fl"><input id="f-name" placeholder=" "><span>Imię i nazwisko</span></label>
    <label class="fl"><input id="f-tel" type="tel" placeholder=" "><span>Telefon</span></label>
    <label class="fl full"><input id="f-subj" placeholder=" "><span><?= $variant === 'order' ? 'Maszyna, którą jesteś zainteresowany' : 'Maszyna i numer seryjny' ?></span></label>
    <label class="fl full"><textarea id="f-msg" rows="3" placeholder=" "></textarea><span>Wiadomość</span></label>
    <div class="full formmsg">Formularz zostanie podłączony w etapie 2 (wysyłka do właściwego oddziału).</div>
  </form>
  <?php endif; ?>
</div></section>
<section class="sec navy"><div class="wrap"><?php partial('branches', ['dept' => $dept]); ?></div></section>

<?php elseif ($slug === 'aktualnosci' || $slug === 'promocje'): ?>
<?php
  $all = data('news');
  if ($slug === 'promocje') $all = array_values(array_filter($all, fn($x) => preg_match('/promoc|rabat|taniej|finansowanie|okazj|wyprzeda/i', $x[0])));
  $pages = max(1, (int)ceil(count($all) / PER_PAGE)); $cur = min($page, $pages);
  $items = array_slice($all, ($cur - 1) * PER_PAGE, PER_PAGE);
  $scenes = ['field', 'dusk', 'gears', 'rows'];
?>
<section class="sec"><div class="wrap">
  <div class="news newsall">
    <?php foreach ($items as $i => [$nslug, $date, $title]): ?>
    <a class="post" href="<?= url("pl/aktualnosci/$nslug") ?>"><div class="vis"><canvas data-scene="<?= $scenes[$i % 4] ?>"></canvas><span class="lab"><?= e(substr($date, 3)) ?></span></div><time><?= e($date) ?></time><h3><?= e($title) ?></h3></a>
    <?php endforeach; ?>
  </div>
  <?php if ($slug === 'aktualnosci' && $pages > 1) partial('pager', ['base' => 'pl/aktualnosci', 'cur' => $cur, 'pages' => $pages]); ?>
</div></section>

<?php elseif ($slug === 'galeria'): ?>
<?php $all = data('galleries'); $pages = max(1, (int)ceil(count($all) / PER_PAGE)); $cur = min($page, $pages); $items = array_slice($all, ($cur - 1) * PER_PAGE, PER_PAGE); ?>
<section class="sec"><div class="wrap">
  <div class="news newsall gal">
    <?php foreach ($items as $i => [$gslug, $title]): preg_match('/(20\d\d)/', $title, $y); ?>
    <a class="post" href="<?= url("pl/galerie/$gslug") ?>"><div class="vis"><canvas data-scene="<?= ['field', 'dusk', 'rows'][$i % 3] ?>"></canvas><span class="lab"><?= e($y[1] ?? '') ?></span></div><time>Galeria</time><h3><?= e($title) ?></h3></a>
    <?php endforeach; ?>
  </div>
  <?php if ($pages > 1) partial('pager', ['base' => 'pl/galerie', 'cur' => $cur, 'pages' => $pages]); ?>
</div></section>

<?php elseif ($slug === 'kariera'): ?>
<section class="sec light"><div class="wrap">
  <div class="jobs rv">
    <?php foreach (data('jobs') as $i => [$jslug, $jt, $jw]): ?>
    <a class="job" href="<?= url("pl/strony/praca/$jslug") ?>"><span class="n"><?= sprintf('%02d', $i + 1) ?></span><h3><?= e($jt) ?> <em class="s">— <?= e($jw) ?></em></h3><span class="go"><svg><use href="#i-ar"/></svg></span></a>
    <?php endforeach; ?>
  </div>
</div></section>

<?php else: ?>
<section class="sec light"><div class="wrap layout2">
  <aside class="subnav rv">
    <span class="kicker">Na skróty</span>
    <ul>
      <?php foreach (cfg('pages') as $s => [$pt]): if (in_array($s, ['aktualnosci', 'kontakt', 'kariera', 'galeria', 'promocje'], true)) continue; ?>
      <li><a href="<?= url("$dept/$s") ?>"<?= $s === $slug ? ' aria-current="page"' : '' ?>><span>›</span><?= e($pt) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </aside>
  <article class="prose rv">
    <p class="intro"><?= e($lead) ?></p>
    <h2>Treść <em class="s">podstrony</em></h2>
    <p>W tym miejscu znajdzie się pełna treść z obecnej strony rolmax.net.pl, przeniesiona 1:1. Na etapie akceptacji motywu pokazujemy typografię, odstępy i elementy, z których będzie zbudowana każda podstrona.</p>
    <ul><li>Nagłówki sekcji w kroju Big Shoulders</li><li>Akcenty w szeryfowej kursywie</li><li>Treść w czytelnym kroju Hanken Grotesk</li></ul>
    <blockquote>Maszyna ma pracować w polu, a nie stać w warsztacie.</blockquote>
    <p>Po akceptacji wyglądu treści będą edytowane w panelu administracyjnym, bez dotykania kodu.</p>
  </article>
</div></section>
<?php endif; ?>
<?php partial('cta-strip', ['dept' => $dept]); ?>
