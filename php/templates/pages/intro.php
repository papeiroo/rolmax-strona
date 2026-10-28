<main id="intro">
  <div class="intro-head">
    <a class="logo" href="<?= url('') ?>" aria-label="GK Rolmax"></a>
    <div class="meta"><span><?= e(cfg('site.tagline')) ?></span><?php foreach (cfg('site.langs') as $l => $h): ?><a href="<?= e($h) ?>"><?= e($l) ?></a><?php endforeach; ?></div>
  </div>
  <div class="doors">
    <a class="door" href="<?= url('czesci') ?>">
      <img class="door-photo" src="<?= asset('img/czesci.jpg') ?>" alt="" decoding="async" style="object-position:50% 45%">
      <div class="no">I · Dział części</div>
      <h2>Części<em class="s">i serwis</em></h2>
      <p>Oryginalne części New Holland, oleje, filtry i akcesoria. Cztery sklepy stacjonarne i sklep internetowy.</p>
      <div class="chips"><span>Części oryginalne</span><span>Sklep online</span><span>Promocje</span><span>Serwis</span></div>
      <span class="enter"><i><svg><use href="#i-ar"/></svg></i>Wejdź do działu</span>
    </a>
    <a class="door" href="<?= url('maszyny') ?>">
      <img class="door-photo" src="<?= asset('img/maszyny.jpg') ?>" alt="" decoding="async" style="object-position:30% 60%">
      <div class="no">II · Dział maszyn</div>
      <h2>Maszyny<em class="s">i finansowanie</em></h2>
      <p>Traktory, kombajny, prasy i ładowarki New Holland z finansowaniem CNH Capital i rolnictwem precyzyjnym.</p>
      <div class="chips"><span>Oferta maszyn</span><span>Finansowanie</span><span>Rolnictwo precyzyjne</span><span>Likwidacja szkód</span></div>
      <span class="enter"><i><svg><use href="#i-ar"/></svg></i>Wejdź do działu</span>
    </a>
  </div>
  <div class="medallion" aria-hidden="true">
    <svg viewBox="0 0 150 150">
      <defs>
        <linearGradient id="gg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#FCE3A0"/><stop offset=".5" stop-color="#E3B04B"/><stop offset="1" stop-color="#9E6E17"/></linearGradient>
        <path id="circ" d="M75 75m-58 0a58 58 0 1 1 116 0a58 58 0 1 1 -116 0"/>
      </defs>
      <circle cx="75" cy="75" r="72" fill="#000B26" stroke="url(#gg)" stroke-width="1"/>
      <circle cx="75" cy="75" r="47" fill="none" stroke="rgba(227,176,75,.35)" stroke-width="1"/>
      <g class="ring"><text font-family="Hanken Grotesk, sans-serif" font-size="9.5" letter-spacing="3.4" fill="#E3B04B"><textPath href="#circ">ROLMAX · JUBILEUSZ 30 LAT · 1997 — 2027 · NEW HOLLAND ·</textPath></text></g>
      <text x="75" y="92" text-anchor="middle" font-family="Big Shoulders Display, Oswald, sans-serif" font-weight="800" font-size="50" fill="url(#gg)">30</text>
      <text x="75" y="106" text-anchor="middle" font-family="Instrument Serif, serif" font-style="italic" font-size="11" fill="#E8EDF6">lat</text>
    </svg>
  </div>
  <div class="intro-foot"><span><?= e(cfg('site.address')) ?></span><span><?= e(cfg('site.phone')) ?></span></div>
</main>
