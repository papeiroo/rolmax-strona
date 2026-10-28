<?php
/* Template Name: Rolmax — strona działu części */
defined('ABSPATH') || exit;
rm_set_dept('czesci');
get_header();
$shop = rm_opt('shop');
?>
<section class="hero">
  <img class="hero-photo" src="<?= esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'rm-hero') : rm_asset('img/czesci.jpg')) ?>" alt="" decoding="async" fetchpriority="high" style="object-position:50% 45%">
  <div class="wrap">
    <div>
      <span class="kicker">Dział części Rolmax</span>
      <h1>Część na czas,<br><em class="s">maszyna w polu</em></h1>
      <p class="lead">Oryginalne części New Holland, filtry, oleje, ogumienie i akcesoria. Cztery sklepy stacjonarne na Lubelszczyźnie i sklep internetowy czynny całą dobę.</p>
      <div class="ctas">
        <a class="btn gold" href="<?= esc_url($shop) ?>">Przejdź do sklepu <span class="ar"></span></a>
        <a class="btn" href="<?= esc_url(rm_url('pl/uslugi/czesci')) ?>">Zapytaj o część <span class="ar"></span></a>
      </div>
    </div>
    <div class="side">
      <div class="big30" aria-hidden="true"><?= (int)rm_opt('jubilee') - (int)rm_opt('founded') ?></div>
      <div class="cap"><em class="s">lat</em><?= rm_e(rm_opt('founded')) ?> — <?= rm_e(rm_opt('jubilee')) ?></div>
      <div class="marks"><a href="<?= esc_url($shop) ?>"><?= rm_e(preg_replace('#^https?://(www\.)?#', '', rtrim($shop, '/'))) ?></a></div>
    </div>
  </div>
  <span class="scroll-cue" aria-hidden="true"></span>
</section>

<div class="svcbar"><div class="wrap">
  <a href="<?= esc_url($shop) ?>"><small>01</small><b>Sklep online</b><span>Zamawiaj 24 h na dobę</span></a>
  <a href="<?= esc_url(rm_url('pl/promocje')) ?>"><small>02</small><b>Promocje</b><span>Akcje miesiąca</span></a>
  <a href="<?= esc_url(rm_url('pl/uslugi/czesci')) ?>"><small>03</small><b>Zapytaj o część</b><span>Cena i termin dostawy</span></a>
  <a href="#sklepy"><small>04</small><b>Sklepy</b><span>Godziny i telefony</span></a>
</div></div>

<?php if (rm_opt('notice_on') === '1'): ?>
<section class="sec" style="padding-block:3.5rem 0">
  <div class="wrap">
    <div class="notice rv">
      <span class="dt"><?= rm_e(rm_opt('notice_date')) ?></span>
      <div><b><?= rm_e(rm_opt('notice_title')) ?></b><p><?= rm_e(rm_opt('notice_text')) ?></p></div>
      <a href="<?= esc_url(rm_url('pl/aktualnosci')) ?>">Aktualności</a>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="sec">
  <div class="wrap">
    <div class="shop rv">
      <a class="big" href="<?= esc_url($shop) ?>">
        <canvas data-scene="gears"></canvas>
        <span class="kicker">Zamawiaj 24/7</span>
        <h3>Sklep internetowy <em class="s">Rolmax</em></h3>
        <p>Szukaj po numerze katalogowym lub modelu maszyny. Zamów z dostawą albo z odbiorem w najbliższym oddziale.</p>
        <span class="btn gold">Przejdź do sklepu <span class="ar"></span></span>
      </a>
      <div class="side">
        <a class="promo" href="<?= esc_url(rm_url('pl/promocje')) ?>"><small>Akcja promocyjna</small><div><h4><?= esc_html(ucfirst(wp_date('F Y'))) ?></h4><p>Ceny promocyjne do końca miesiąca lub do wyczerpania zapasów.</p></div></a>
        <a href="<?= esc_url(rm_url('pl/uslugi/serwis')) ?>"><small>Serwis</small><div><h4>Naprawy i przeglądy</h4><p>Serwis w Świdniku i Miączynie oraz serwis mobilny w polu.</p></div></a>
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
      <?php foreach (rm_seed('parts') as $i => [$ic, $name, $desc]): ?>
      <a class="cat" href="<?= esc_url($shop) ?>"><span class="sku"><?= sprintf('%02d', $i + 1) ?></span><svg class="ic"><use href="#<?= esc_attr($ic) ?>"/></svg><h3><?= rm_e($name) ?></h3><p><?= rm_e($desc) ?></p></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec navy" id="sklepy">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Godziny otwarcia</span><h2>Sklepy <em class="s">działu części</em></h2></div>
      <p>Godziny i telefony edytujesz w panelu: Oddziały.</p>
    </div>
    <div class="hours rv">
      <?php foreach (rm_branches() as $b): if (empty($b['parts'])) continue; ?>
      <div class="hour"><h4><?= rm_e($b['n']) ?></h4>
        <?php foreach ($b['parts'][0] as [$d, $h]): ?><div><span><?= rm_e($d) ?></span><span<?= $h === 'nieczynne' ? ' class="x"' : '' ?>><?= rm_e($h) ?></span></div><?php endforeach; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="margin-top:4rem"><?php rm_part('branches', ['dept' => 'czesci']); ?></div>
  </div>
</section>

<?php rm_part('jubilee', ['line' => 'lat części i serwisu', 'title' => '30 lat <em class="s">przy Twojej maszynie</em>', 'text' => 'W 2027 roku świętujemy jubileusz. Przygotowujemy jubileuszowe promocje na części, oleje i filtry. Śledź aktualności i nasz profil na Facebooku.']); ?>

<section class="sec">
  <div class="wrap">
    <div class="head rv">
      <div><span class="kicker">Aktualności</span><h2>Promocje <em class="s">i ogłoszenia</em></h2></div>
      <a class="btn" href="<?= esc_url(rm_url('pl/aktualnosci')) ?>">Wszystkie aktualności <span class="ar"></span></a>
    </div>
    <?php rm_part('news'); ?>
  </div>
</section>
<?php rm_part('cta-strip'); get_footer(); ?>
