<?php
/** @var string $dept */
$items = data('news');
if ($dept === 'czesci') usort($items, fn($a, $b) => preg_match('/czci|czesci|promoc/', $b[0]) <=> preg_match('/czci|czesci|promoc/', $a[0]));
$items = array_slice($items, 0, 3);
$scenes = ['field', 'dusk', 'gears'];
?>
<div class="news">
  <?php foreach ($items as $i => [$slug, $date, $title]): ?>
  <a class="post<?= $i === 0 ? ' feat' : '' ?>" href="<?= url("pl/aktualnosci/$slug") ?>">
    <div class="vis"><canvas data-scene="<?= $scenes[$i] ?>"></canvas><span class="lab"><?= e(substr($date, 0, 5)) ?></span></div>
    <time><?= e($date) ?></time><h3><?= e($title) ?></h3>
  </a>
  <?php endforeach; ?>
</div>
