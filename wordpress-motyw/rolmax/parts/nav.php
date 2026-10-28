<?php
$dept = $args['dept'];
$d = rm_departments()[$dept];
$cur = function (string $path) { $u = trailingslashit(rm_url($path)); $req = trailingslashit(home_url($GLOBALS['wp']->request ?? '')); return $u === $req ? ' aria-current="page"' : ''; };
$terms = rm_machine_terms();
?>
<header class="hd">
  <div class="wrap">
    <a class="logo" href="<?= esc_url(rm_url('pl')) ?>" aria-label="GK Rolmax — wybór działu"></a>
    <nav class="nav" aria-label="Menu główne">
      <button class="burger xclose" type="button" aria-label="Zamknij menu"><svg><use href="#i-x"/></svg></button>
      <ul>
        <?php if ($dept === 'maszyny'): ?>
        <li class="mg">
          <button class="nl" type="button" aria-expanded="false">Oferta <svg><use href="#i-chev"/></svg></button>
          <div class="mega mega-m"><div class="wrap">
            <ul class="mm-cats" role="tablist" aria-label="Kategorie maszyn">
              <?php foreach ($terms as $i => $t): ?>
              <li><a href="<?= esc_url(get_term_link($t)) ?>" role="tab" id="mmt-<?= esc_attr($t->slug) ?>" aria-controls="mmp-<?= esc_attr($t->slug) ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>" data-mm="<?= esc_attr($t->slug) ?>"><span><?= rm_e(rm_term_meta($t, 'code')) ?></span><?= rm_e($t->name) ?><svg class="ch"><use href="#i-ar"/></svg></a></li>
              <?php endforeach; ?>
            </ul>
            <div class="mm-panels">
              <?php foreach ($terms as $i => $t): $models = rm_models($t); $icon = rm_term_meta($t, 'icon', 'm-tractor'); $c = count($models); ?>
              <div class="mm-panel" role="tabpanel" id="mmp-<?= esc_attr($t->slug) ?>" aria-labelledby="mmt-<?= esc_attr($t->slug) ?>"<?= $i ? ' hidden' : '' ?>>
                <div class="mm-grid<?= $c <= 2 ? ' few' : '' ?>">
                  <?php foreach ($models as $m): ?>
                  <a class="mm-item" href="<?= esc_url(get_permalink($m)) ?>"><span class="th"><?= rm_model_thumb($m, $icon, 'medium') ?></span><b><?= rm_e(get_the_title($m)) ?></b></a>
                  <?php endforeach; ?>
                </div>
                <div class="mm-foot">
                  <span><b><?= $c ?></b> <?= rm_series_word($c) ?> · <?= rm_e($t->name) ?></span>
                  <a href="<?= esc_url(get_term_link($t)) ?>">Zobacz kategorię <span class="ar"></span></a>
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
            <li><a href="<?= esc_url(rm_url('pl/uslugi/finansowanie')) ?>">Finansowanie</a></li>
            <li><a href="<?= esc_url(rm_url('pl/uslugi/serwis')) ?>">Serwis</a></li>
            <li><a href="<?= esc_url(rm_url('pl/uslugi/likwidacja-szkod')) ?>">Likwidacja szkód</a></li>
            <li><a href="<?= esc_url(rm_url('pl/uslugi/rolnictwo-precyzyjne')) ?>">Rolnictwo precyzyjne</a></li>
            <li><a href="https://cnhi-dealer-rolmax.webmag.io/rolnictwo-precyzyjne-2026/start">Blue &amp; you</a></li>
          </ul>
        </li>
        <?php else: ?>
        <li class="mg">
          <button class="nl" type="button" aria-expanded="false">Asortyment <svg><use href="#i-chev"/></svg></button>
          <div class="mega"><div class="wrap">
            <div class="mega-list">
              <?php foreach (rm_seed('parts') as $i => [$ic, $name, $sub]): ?>
                <a href="<?= esc_url(rm_opt('shop')) ?>"><span class="c"><?= sprintf('%02d', $i + 1) ?></span><b><?= rm_e($name) ?></b><small><?= rm_e($sub) ?></small></a>
              <?php endforeach; ?>
            </div>
            <div class="mega-aside">
              <span class="kicker">Zamawiaj 24/7</span>
              <h4>Sklep <em class="s">internetowy</em></h4>
              <p>Szukaj po numerze katalogowym lub modelu maszyny. Odbiór w najbliższym oddziale.</p>
              <a class="btn gold" href="<?= esc_url(rm_opt('shop')) ?>">Przejdź do sklepu <span class="ar"></span></a>
            </div>
          </div></div>
        </li>
        <li><a class="nl" href="<?= esc_url(rm_url('pl/promocje')) ?>"<?= $cur('pl/promocje') ?>>Promocje</a></li>
        <li class="rel">
          <button class="nl" type="button" aria-expanded="false">Usługi <svg><use href="#i-chev"/></svg></button>
          <ul class="drop">
            <li><a href="<?= esc_url(rm_url('pl/uslugi/czesci')) ?>">Części · zamówienia</a></li>
            <li><a href="<?= esc_url(rm_url('pl/uslugi/serwis')) ?>">Serwis</a></li>
            <li><a href="<?= esc_url(rm_url('pl/kontakt/support')) ?>">Zgłoszenie serwisowe</a></li>
            <li><a href="<?= esc_url(rm_url('pl/uslugi/likwidacja-szkod')) ?>">Likwidacja szkód</a></li>
          </ul>
        </li>
        <?php endif; ?>
        <li><a class="nl" href="<?= esc_url(rm_url('pl/aktualnosci')) ?>"<?= $cur('pl/aktualnosci') ?>>Aktualności</a></li>
        <li class="rel">
          <button class="nl" type="button" aria-expanded="false">Firma <svg><use href="#i-chev"/></svg></button>
          <ul class="drop">
            <li><a href="<?= esc_url(rm_url('pl/strony/o-nas')) ?>">O nas</a></li>
            <li><a href="<?= esc_url(rm_url('pl/galerie')) ?>">Galeria</a></li>
            <li><a href="<?= esc_url(rm_url('pl/strony/praca')) ?>">Praca</a></li>
          </ul>
        </li>
        <li><a class="nl" href="<?= esc_url(rm_url('pl/kontakt')) ?>"<?= $cur('pl/kontakt') ?>>Kontakt</a></li>
        <li><a class="nl cta" href="<?= esc_url($d['cta'][1]) ?>"><?= rm_e($d['cta'][0]) ?></a></li>
      </ul>
    </nav>
    <button class="burger xopen" type="button" aria-label="Otwórz menu"><svg><use href="#i-menu"/></svg></button>
  </div>
</header>
