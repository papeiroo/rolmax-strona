<?php $dept = 'czesci'; ?>
<section class="hero">
  <img class="hero-photo" src="<?= asset('img/czesci.jpg') ?>" alt="" decoding="async" fetchpriority="high" style="object-position:50% 45%">
  <div class="wrap">
    <div>
      <span class="kicker">Dział części Rolmax</span>
      <h1>Część na czas,<br><em class="s">maszyna w polu</em></h1>
      <p class="lead">Oryginalne części New Holland, filtry, oleje, ogumienie i akcesoria. Cztery sklepy stacjonarne na Lubelszczyźnie i sklep internetowy czynny całą dobę.</p>
      <div class="ctas">
        <a class="btn gold" href="<?= e(cfg('site.shop')) ?>">Przejdź do sklepu <span class="ar"></span></a>
        <a class="btn" href="<?= url('czesci/czesci-zamowienia') ?>">Zapytaj o część <span class="ar"></span></a>
      </div>
    </div>
    <div class="side">
      <div class="big30" aria-hidden="true">30</div>
      <div class="cap"><em class="s">lat</em>1997 — 2027</div>
      <div class="marks"><a href="<?= e(cfg('site.shop')) ?>">rolmax-sklep.pl</a></div>
    </div>
  </div>
  <span class="scroll-cue" aria-hidden="true"></span>
</section>

<div class="svcbar"><div class="wrap">
  <a href="<?= e(cfg('site.shop')) ?>"><small>01</small><b>Sklep online</b><span>Zamawiaj 24 h na dobę</span></a>
  <a href="<?= url('czesci/promocje') ?>"><small>02</small><b>Promocje</b><span>Październik 2026</span></a>
  <a href="<?= url('czesci/czesci-zamowienia') ?>"><small>03</small><b>Zapytaj o część</b><span>Cena i termin dostawy</span></a>
  <a href="<?= url('czesci#sklepy') ?>"><small>04</small><b>Sklepy</b><span>Godziny i telefony</span></a>
</div></div>

<section class="sec" style="padding-block:3.5rem 0">
  <div class="wrap">
    <div class="notice rv">
      <span class="dt">06.10</span>
      <div><b>Soboty nieczynne do końca lutego</b><p>W sezonie jesienno-zimowym sklepy stacjonarne działu części pracują od poniedziałku do piątku.</p></div>
      <a href="<?= url('czesci/aktualnosci') ?>">Ogłoszenie</a>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="shop rv">
      <a class="big" href="<?= e(cfg('site.shop')) ?>">
        <canvas data-scene="gears"></canvas>
        <span class="kicker">Zamawiaj 24/7</span>
        <h3>Sklep internetowy <em class="s">Rolmax</em></h3>
        <p>Szukaj po numerze katalogowym lub modelu maszyny. Zamów z dostawą albo z odbiorem w najbliższym oddziale.</p>
        <span class="btn gold">Przejdź do sklepu <span class="ar"></span></span>
      </a>
      <div class="side">
        <a class="promo" href="<?= url('czesci/promocje') ?>"><small>Akcja promocyjna</small><div><h4>Październik 2026</h4><p>Ceny promocyjne do końca miesiąca lub do wyczerpania zapasów.</p></div></a>
        <a href="<?= url('czesci/serwis') ?>"><small>Serwis</small><div><h4>Naprawy i przeglądy</h4><p>Serwis w Świdniku i Miączynie oraz serwis mobilny w polu.</p></div></a>
      </div>
    </div>
  </div>
</section>

<section class="sec light">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Asortyment</span><h2>Wszystko <em class="s">do Twojej</em> maszyny</h2></div>
      <p>Części do ciągników, kombajnów i maszyn towarzyszących. Od ręki z magazynu lub na zamówienie z magazynu centralnego.</p>
    </div>
    <div class="cats">
      <?php foreach (cfg('parts') as $i => [$ic, $name, $desc]): ?>
      <a class="cat" href="<?= e(cfg('site.shop')) ?>"><span class="sku"><?= sprintf('%02d', $i + 1) ?></span><svg class="ic"><use href="#<?= e($ic) ?>"/></svg><h3><?= e($name) ?></h3><p><?= e($desc) ?></p></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec navy" id="sklepy">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Godziny otwarcia</span><h2>Sklepy <em class="s">działu części</em></h2></div>
      <p>Godziny stałe. W sezonie jesienno-zimowym soboty są nieczynne do końca lutego.</p>
    </div>
    <div class="hours rv">
      <?php foreach (cfg('branches') as $b): ?>
      <div class="hour"><h4><?= e($b['n']) ?></h4>
        <?php foreach ($b['parts'][0] as [$d, $h]): ?><div><span><?= e($d) ?><?= ($d === 'Sobota' && $h !== 'nieczynne') ? '*' : '' ?></span><span<?= $h === 'nieczynne' ? ' class="x"' : '' ?>><?= e($h) ?></span></div><?php endforeach; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:1.2rem;color:var(--mute);font-size:.85rem">* Poza sezonem jesienno-zimowym.</p>
    <div style="margin-top:4rem"><?php partial('branches', ['dept' => $dept]); ?></div>
  </div>
</section>

<?php partial('jubilee', ['line' => 'lat części i serwisu', 'title' => '30 lat <em class="s">przy Twojej maszynie</em>', 'text' => 'W 2027 roku świętujemy jubileusz. Przygotowujemy jubileuszowe promocje na części, oleje i filtry. Śledź aktualności i nasz profil na Facebooku.']); ?>

<section class="sec">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Aktualności</span><h2>Promocje <em class="s">i ogłoszenia</em></h2></div>
      <a class="btn" href="<?= url('czesci/aktualnosci') ?>">Wszystkie aktualności <span class="ar"></span></a>
    </div>
    <?php partial('news', ['dept' => $dept]); ?>
  </div>
</section>
<?php partial('cta-strip', ['dept' => $dept]); ?>
