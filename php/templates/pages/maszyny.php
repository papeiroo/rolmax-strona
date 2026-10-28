<?php $dept = 'maszyny'; ?>
<section class="hero">
  <img class="hero-photo" src="<?= asset('img/maszyny.jpg') ?>" alt="" decoding="async" fetchpriority="high" style="object-position:40% 55%">
  <div class="wrap">
    <div>
      <span class="kicker"><?= e(cfg('site.tagline')) ?></span>
      <h1>Siła,<br>która <em class="s">pracuje z&nbsp;Tobą</em></h1>
      <p class="lead">Od 1997 roku wyposażamy gospodarstwa Lubelszczyzny w maszyny New Holland. Doradzamy, finansujemy i serwisujemy przez cały okres pracy maszyny.</p>
      <div class="ctas">
        <a class="btn gold" href="<?= url('maszyny/kontakt') ?>">Zainteresowany zakupem <span class="ar"></span></a>
        <a class="btn" href="<?= url('maszyny/serwis') ?>">Serwis maszyn <span class="ar"></span></a>
      </div>
    </div>
    <div class="side">
      <div class="big30" aria-hidden="true">30</div>
      <div class="cap"><em class="s">lat</em>1997 — 2027</div>
      <div class="marks"><a href="https://agriculture.newholland.com/eu/pl-pl">New Holland</a><a href="https://www.cnhcapital.com/pl_pl">CNH Capital</a></div>
    </div>
  </div>
  <span class="scroll-cue" aria-hidden="true"></span>
</section>

<div class="svcbar"><div class="wrap">
  <a href="<?= url('maszyny/kontakt') ?>"><small>01</small><b>Zakup maszyny</b><span>Rozmowa z doradcą handlowym</span></a>
  <a href="<?= url('maszyny/finansowanie') ?>"><small>02</small><b>Finansowanie</b><span>Leasing i kredyt CNH Capital</span></a>
  <a href="<?= url('maszyny/serwis') ?>"><small>03</small><b>Serwis</b><span>Warsztat i serwis mobilny</span></a>
  <a href="https://agriculture.newholland.com/eu/pl-pl/o-nas/zakupy-i-uslugi/zakup/konfigurator"><small>04</small><b>Konfigurator</b><span>Złóż własną maszynę</span></a>
</div></div>

<section class="sec light">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Oferta New Holland</span><h2>Wybierz <em class="s">swoją</em> maszynę</h2></div>
      <p>Pełna gama maszyn rolniczych i budowlanych New Holland, dostępna we wszystkich czterech oddziałach Rolmax.</p>
    </div>
    <div class="fleet">
      <?php $i = 0; foreach (cfg('machines') as $slug => [$code, $name, , $desc]): $i++; ?>
      <a class="unit" href="<?= url("maszyny/oferta/$slug") ?>"><span class="idx"><?= sprintf('%02d', $i) ?> / 09</span><span class="code"><?= e($code) ?></span><h3><?= e($name) ?></h3><p><?= e($desc) ?></p><span class="go"><svg><use href="#i-ar"/></svg></span></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec navy">
  <div class="wrap finance">
    <div class="txt rv">
      <span class="kicker">CNH Capital</span>
      <h2>Finansowanie <em class="s">szyte na miarę</em></h2>
      <p>Leasing, kredyt i harmonogramy spłat dopasowane do sezonowości gospodarstwa. Ofertę przygotowujemy razem z CNH Capital, finansowym partnerem New Holland.</p>
      <ul>
        <li>Leasing operacyjny i finansowy, kredyt inwestycyjny</li>
        <li>Raty dopasowane do przychodów z gospodarstwa</li>
        <li>T5, T6 i T7 dostępne teraz w atrakcyjnych warunkach</li>
      </ul>
      <a class="btn" href="<?= url('maszyny/finansowanie') ?>">Warunki finansowania <span class="ar"></span></a>
    </div>
    <a class="panel fincard rv" href="<?= url('maszyny/finansowanie') ?>">
      <canvas data-scene="rows"></canvas>
      <span class="kicker">PLM · Blue &amp; you</span>
      <h3>Rolnictwo <em class="s">precyzyjne</em></h3>
      <p>Prowadzenie GPS, zmienne dawkowanie i dane z pola. Mniej nakładów na hektar i większa kontrola nad plonem.</p>
      <span class="btn">Dowiedz się więcej <span class="ar"></span></span>
    </a>
  </div>
</section>

<?php partial('jubilee', ['line' => 'lat razem z rolnikami', 'title' => 'Jedna droga, <em class="s">wspólny cel</em>', 'text' => 'W 2027 roku Rolmax kończy 30 lat. Dziękujemy rolnikom, którzy są z nami od 1997 roku. Na jubileuszowy rok przygotowujemy pokazy maszyn, dni otwarte i oferty specjalne.', 'timeline' => true]); ?>

<section class="sec light">
  <div class="wrap about">
    <div class="txt rv">
      <span class="kicker">O firmie</span>
      <h2>Napędzani pasją <em class="s">od 1997</em></h2>
      <p>Rolmax jest autoryzowanym przedstawicielem New Holland. Siedziba firmy mieści się w Świdniku, a oddziały w Miączynie, Rudniku i Białce obsługują rolników z całego województwa lubelskiego.</p>
      <p>W każdym oddziale działa sprzedaż maszyn i dział części, a w Świdniku i Miączynie także serwis.</p>
      <div class="quote">Maszyna ma pracować w polu, a nie stać w warsztacie.</div>
      <a class="btn dark" href="<?= url('maszyny/o-firmie') ?>">Poznaj nas <span class="ar"></span></a>
    </div>
    <div class="figs rv">
      <div class="fig"><b>30</b><span>lat w 2027</span></div>
      <div class="fig"><b>1997</b><span>rok założenia</span></div>
      <div class="fig"><b>4</b><span>oddziały na Lubelszczyźnie</span></div>
      <div class="fig"><b>9</b><span>kategorii maszyn NH</span></div>
    </div>
  </div>
</section>

<div class="marq" aria-hidden="true"><div class="track">
  <?php for ($k = 0; $k < 2; $k++): ?><span>New Holland</span><span><em>CNH Capital</em></span><span>Rolnictwo precyzyjne</span><span><em>od 1997</em></span><span>Serwis mobilny</span><span><em>30 lat</em></span><?php endfor; ?>
</div></div>

<section class="sec">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Aktualności</span><h2>Z życia <em class="s">Rolmax</em></h2></div>
      <a class="btn" href="<?= url('maszyny/aktualnosci') ?>">Wszystkie aktualności <span class="ar"></span></a>
    </div>
    <?php partial('news', ['dept' => $dept]); ?>
  </div>
</section>

<section class="sec navy">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Sieć dealerska</span><h2>Nasze <em class="s">oddziały</em></h2></div>
      <p>Cztery lokalizacje w województwie lubelskim. Wybierz oddział, aby zobaczyć godziny i kontakty.</p>
    </div>
    <?php partial('branches', ['dept' => $dept]); ?>
  </div>
</section>
<?php partial('cta-strip', ['dept' => $dept]); ?>
