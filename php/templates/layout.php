<?php /** @var string $title @var string|null $dept @var string $body */ ?>
<!doctype html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<?php
  $desc = $desc ?? 'Rolmax — autoryzowany dealer New Holland. Maszyny rolnicze, części, serwis i finansowanie. Świdnik, Miączyn, Rudnik, Białka. Od 1997 roku.';
  $canon = canonical($pub ?? 'pl', (int)($page ?? 1));
?>
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<?php if (!empty($noindex)): ?><meta name="robots" content="noindex"><?php else: ?><link rel="canonical" href="<?= e($canon) ?>"><?php endif; ?>
<meta property="og:type" content="website">
<meta property="og:site_name" content="Rolmax">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:url" content="<?= e($canon) ?>">
<meta property="og:locale" content="pl_PL">
<?php if (in_array($pub ?? '', ['pl', 'pl/kontakt'], true)) partial('schema'); ?>
<meta name="theme-color" content="#000B26">
<link rel="icon" href="<?= asset('img/logo.png') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@300;500;700;800&family=Instrument+Serif:ital@0;1&family=Hanken+Grotesk:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="<?= asset('css/app.css') ?>">
</head>
<body class="<?= $dept ? 'dept-' . e($dept) : 'is-intro' ?>">
<?php partial('icons'); ?>
<div class="grain" aria-hidden="true"></div>
<?php partial('ribbon'); ?>
<?php if ($dept): ?>
  <?php partial('topbar', ['dept' => $dept]); ?>
  <?php partial('header', ['dept' => $dept]); ?>
<?php endif; ?>
<?= $body ?>
<?php if ($dept) partial('footer', ['dept' => $dept]); ?>
<script src="<?= asset('js/app.js') ?>" defer></script>
</body>
</html>
