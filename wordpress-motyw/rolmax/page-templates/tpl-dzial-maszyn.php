<?php
/* Template Name: Rolmax — strona działu maszyn */
defined('ABSPATH') || exit;
rm_set_dept('maszyny');
get_header();
$terms = rm_machine_terms();
?>
<section class="hero">
  <img class="hero-photo" src="<?= esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'rm-hero') : rm_asset('img/maszyny.jpg')) ?>" alt="" decoding="async" fetchpriority="high" style="object-position:40% 55%">
  <div class="wrap">
    <div>
      <span class="kicker">Autoryzowany dealer New Holland</span>
      <h1>Siła,<br>która <em class="s">pracuje z&nbsp;Tobą</em></h1>
      <p class="lead">Od 1997 roku wyposażamy gospodarstwa Lubelszczyzny w maszyny New Holland. Doradzamy, finansujemy i serwisujemy przez cały okres pracy maszyny.</p>
      <div class="ctas">
        <a class="btn gold" href="<?= esc_url(rm_url('pl/kontakt/order')) ?>">Zainteresowany zakupem <span class="ar"></span></a>
        <a class="btn" href="<?= esc_url(rm_url('pl/kontakt/support')) ?>">Formularz serwisowy <span class="ar"></span></a>
      </div>
    </div>
    <div class="side">
      <div class="big30" aria-hidden="true"><?= (int)rm_opt('jubilee') - (int)rm_opt('founded') ?></div>
      <div class="cap"><em class="s">lat</em><?= rm_e(rm_opt('founded')) ?> — <?= rm_e(rm_opt('jubilee')) ?></div>
      <div class="marks"><a href="https://agriculture.newholland.com/eu/pl-pl">New Holland</a><a href="https://www.cnhcapital.com/pl_pl">CNH Capital</a></div>
    </div>
  </div>
  <span class="scroll-cue" aria-hidden="true"></span>
</section>

<div class="svcbar"><div class="wrap">
  <a href="<?= esc_url(rm_url('pl/kontakt/order')) ?>"><small>01</small><b>Zakup maszyny</b><span>Rozmowa z doradcą handlowym</span></a>
  <a href="<?= esc_url(rm_url('pl/uslugi/finansowanie')) ?>"><small>02</small><b>Finansowanie</b><span>Leasing i kredyt CNH Capital</span></a>
  <a href="<?= esc_url(rm_url('pl/uslugi/serwis')) ?>"><small>03</small><b>Serwis</b><span>Warsztat i serwis mobilny</span></a>
  <a href="https://agriculture.newholland.com/eu/pl-pl/o-nas/zakupy-i-uslugi/zakup/konfigurator"><small>04</small><b>Konfigurator</b><span>Złóż własną maszynę</span></a>
</div></div>

<section class="sec light">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Oferta New Holland</span><h2>Wybierz <em class="s">swoją</em> maszynę</h2></div>
      <p>Pełna gama maszyn rolniczych i budowlanych New Holland, dostępna we wszystkich czterech oddziałach Rolmax.</p>
    </div>
    <?php get_template_part('parts/fleet', null, ['terms' => $terms]); ?>
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
        <li>Atrakcyjne warunki na wybrane serie ciągników</li>
      </ul>
      <a class="btn" href="<?= esc_url(rm_url('pl/uslugi/finansowanie')) ?>">Warunki finansowania <span class="ar"></span></a>
    </div>
    <a class="panel fincard rv" href="<?= esc_url(rm_url('pl/uslugi/rolnictwo-precyzyjne')) ?>">
      <canvas data-scene="rows"></canvas>
      <span class="kicker">PLM · Blue &amp; you</span>
      <h3>Rolnictwo <em class="s">precyzyjne</em></h3>
      <p>Prowadzenie GPS, zmienne dawkowanie i dane z pola. Mniej nakładów na hektar i większa kontrola nad plonem.</p>
      <span class="btn">Dowiedz się więcej <span class="ar"></span></span>
    </a>
  </div>
</section>

<?php rm_part('jubilee', ['line' => 'lat razem z rolnikami', 'title' => 'Jedna droga, <em class="s">wspólny cel</em>', 'text' => 'W 2027 roku Rolmax kończy 30 lat. Dziękujemy rolnikom, którzy są z nami od 1997 roku. Na jubileuszowy rok przygotowujemy pokazy maszyn, dni otwarte i oferty specjalne.', 'timeline' => true]); ?>

<section class="sec light">
  <div class="wrap about">
    <div class="txt rv">
      <span class="kicker">O firmie</span>
      <h2>Napędzani pasją <em class="s">od 1997</em></h2>
      <p>Rolmax jest autoryzowanym przedstawicielem New Holland. Siedziba firmy mieści się w Świdniku, a oddziały w Miączynie, Rudniku i Białce obsługują rolników z całego województwa lubelskiego.</p>
      <p>W każdym oddziale działa sprzedaż maszyn i dział części, a w Świdniku i Miączynie także serwis.</p>
      <div class="quote">Maszyna ma pracować w polu, a nie stać w warsztacie.</div>
      <a class="btn dark" href="<?= esc_url(rm_url('pl/strony/o-nas')) ?>">Poznaj nas <span class="ar"></span></a>
    </div>
    <div class="figs rv">
      <div class="fig"><b><?= (int)rm_opt('jubilee') - (int)rm_opt('founded') ?></b><span>lat w <?= rm_e(rm_opt('jubilee')) ?></span></div>
      <div class="fig"><b><?= rm_e(rm_opt('founded')) ?></b><span>rok założenia</span></div>
      <div class="fig"><b><?= count(rm_branches()) ?></b><span>oddziały na Lubelszczyźnie</span></div>
      <div class="fig"><b><?= count($terms) ?></b><span>kategorii maszyn NH</span></div>
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
      <a class="btn" href="<?= esc_url(rm_url('pl/aktualnosci')) ?>">Wszystkie aktualności <span class="ar"></span></a>
    </div>
    <?php rm_part('news'); ?>
  </div>
</section>

<section class="sec navy">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Sieć dealerska</span><h2>Nasze <em class="s">oddziały</em></h2></div>
      <p>Cztery lokalizacje w województwie lubelskim. Wybierz oddział, aby zobaczyć godziny i kontakty.</p>
    </div>
    <?php rm_part('branches', ['dept' => 'maszyny']); ?>
  </div>
</section>
<?php rm_part('cta-strip'); get_footer(); ?>
