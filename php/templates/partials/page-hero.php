<?php /** @var string $dept @var string $kicker @var string $h1 @var string $lead @var string $scene @var array $crumbs */ ?>
<section class="phero">
  <canvas data-scene="<?= e($scene) ?>"></canvas>
  <div class="wrap">
    <nav class="crumbs" aria-label="Okruszki">
      <a href="<?= url('') ?>">Rolmax</a><span>/</span><a href="<?= url($dept) ?>"><?= e(cfg("departments.$dept.label")) ?></a>
      <?php foreach ($crumbs as [$lab, $href]): ?><span>/</span><?= $href ? '<a href="' . url($href) . '">' . e($lab) . '</a>' : '<b>' . e($lab) . '</b>' ?><?php endforeach; ?>
    </nav>
    <span class="kicker"><?= e($kicker) ?></span>
    <h1><?= $h1 ?></h1>
    <p class="lead"><?= e($lead) ?></p>
  </div>
</section>
