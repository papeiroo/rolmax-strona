<?php
$machines = cfg('machines');
$cta = cfg("departments.$dept.cta");
$ctaHref = str_starts_with($cta[1], 'http') ? $cta[1] : url("$dept/{$cta[1]}");
$cur = fn(string $p) => is_active("$dept/$p") ? ' aria-current="page"' : '';
?>
<header class="hd">
  <div class="wrap">
    <a class="logo" href="<?= url('') ?>" aria-label="GK Rolmax — wybór działu"></a>
    <nav class="nav" aria-label="Menu główne">
      <button class="burger xclose" type="button" aria-label="Zamknij menu"><svg><use href="#i-x"/></svg></button>
      <ul>
        <?php if ($dept === 'maszyny'): ?>
        <li class="mg">
          <button class="nl" type="button" aria-expanded="false">Oferta <svg><use href="#i-chev"/></svg></button>
          <div class="mega mega-m"><div class="wrap">
            <ul class="mm-cats" role="tablist" aria-label="Kategorie maszyn">
              <?php $i = 0; foreach ($machines as $slug => [$code, $name]): ?>
              <li><a href="<?= url("$dept/oferta/$slug") ?>" role="tab" id="mmt-<?= e($slug) ?>" aria-controls="mmp-<?= e($slug) ?>" aria-selected="<?= $i++ === 0 ? 'true' : 'false' ?>" data-mm="<?= e($slug) ?>"><span><?= e($code) ?></span><?= e($name) ?><svg class="ch"><use href="#i-ar"/></svg></a></li>
              <?php endforeach; ?>
            </ul>
            <div class="mm-panels">
              <?php $i = 0; foreach ($machines as $slug => [$code, $name]): $icon = cfg("machine_icons.$slug"); $models = cfg("models.$slug", []); ?>
              <div class="mm-panel" role="tabpanel" id="mmp-<?= e($slug) ?>" aria-labelledby="mmt-<?= e($slug) ?>"<?= $i++ ? ' hidden' : '' ?>>
                <div class="mm-grid<?= count($models) <= 2 ? ' few' : '' ?>">
                  <?php foreach ($models as [$mName, $mSlug]): ?>
                  <a class="mm-item" href="<?= url("$dept/oferta/$slug/$mSlug") ?>"><span class="th"><?= model_thumb($mSlug, $icon) ?></span><b><?= e($mName) ?></b></a>
                  <?php endforeach; ?>
                </div>
                <div class="mm-foot">
                  <span><b><?= count($models) ?></b> <?= count($models) === 1 ? 'seria' : (count($models) < 5 ? 'serie' : 'serii') ?> · <?= e($name) ?></span>
                  <a href="<?= url("$dept/oferta/$slug") ?>">Zobacz kategorię <span class="ar"></span></a>
                  <a class="gold" href="https://agriculture.newholland.com/eu/pl-pl/o-nas/zakupy-i-uslugi/zakup/konfigurator">Konfigurator New Holland <span class="ar"></span></a>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div></div>
        </li>
        <li class="rel">
          <button class="nl" type="button" aria-expanded="false">Usługi <svg><use href="#i-chev"/></svg></button>
          <ul class="drop">
            <li><a href="<?= url("$dept/finansowanie") ?>">Finansowanie</a></li>
            <li><a href="<?= url("$dept/serwis") ?>">Serwis</a></li>
            <li><a href="<?= url("$dept/likwidacja-szkod") ?>">Likwidacja szkód</a></li>
            <li><a href="<?= url("$dept/rolnictwo-precyzyjne") ?>">Rolnictwo precyzyjne</a></li>
            <li><a href="https://cnhi-dealer-rolmax.webmag.io/rolnictwo-precyzyjne-2026/start">Blue &amp; you</a></li>
          </ul>
        </li>
        <?php else: ?>
        <li class="mg">
          <button class="nl" type="button" aria-expanded="false">Asortyment <svg><use href="#i-chev"/></svg></button>
          <div class="mega"><div class="wrap">
            <div class="mega-list">
              <?php foreach (cfg('parts') as $i => [$ic, $name, $sub]): ?>
                <a href="<?= e(cfg('site.shop')) ?>"><span class="c"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span><b><?= e($name) ?></b><small><?= e($sub) ?></small></a>
              <?php endforeach; ?>
            </div>
            <div class="mega-aside">
              <span class="kicker">Zamawiaj 24/7</span>
              <h4>Sklep <em class="s">internetowy</em></h4>
              <p>Szukaj po numerze katalogowym lub modelu maszyny. Odbiór w najbliższym oddziale.</p>
              <a class="btn gold" href="<?= e(cfg('site.shop')) ?>">rolmax-sklep.pl <span class="ar"></span></a>
            </div>
          </div></div>
        </li>
        <li><a class="nl" href="<?= url("$dept/promocje") ?>"<?= $cur('promocje') ?>>Promocje</a></li>
        <li class="rel">
          <button class="nl" type="button" aria-expanded="false">Usługi <svg><use href="#i-chev"/></svg></button>
          <ul class="drop">
            <li><a href="<?= url("$dept/czesci-zamowienia") ?>">Części · zamówienia</a></li>
            <li><a href="<?= url("$dept/serwis") ?>">Serwis</a></li>
            <li><a href="https://rolmax.net.pl/pl/kontakt/support">Formularz serwisowy</a></li>
            <li><a href="<?= url("$dept/likwidacja-szkod") ?>">Likwidacja szkód</a></li>
          </ul>
        </li>
        <?php endif; ?>
        <li><a class="nl" href="<?= url("$dept/aktualnosci") ?>"<?= $cur('aktualnosci') ?>>Aktualności</a></li>
        <li class="rel">
          <button class="nl" type="button" aria-expanded="false">Firma <svg><use href="#i-chev"/></svg></button>
          <ul class="drop">
            <li><a href="<?= url("$dept/o-firmie") ?>">O firmie</a></li>
            <li><a href="<?= url("$dept/galeria") ?>">Galeria</a></li>
            <li><a href="<?= url("$dept/kariera") ?>">Kariera</a></li>
          </ul>
        </li>
        <li><a class="nl" href="<?= url("$dept/kontakt") ?>"<?= $cur('kontakt') ?>>Kontakt</a></li>
        <li><a class="nl cta" href="<?= e($ctaHref) ?>"><?= e($cta[0]) ?></a></li>
      </ul>
    </nav>
    <button class="burger xopen" type="button" aria-label="Otwórz menu"><svg><use href="#i-menu"/></svg></button>
  </div>
</header>
