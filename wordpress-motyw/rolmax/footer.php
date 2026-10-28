<?php defined('ABSPATH') || exit; $rm_d = rm_dept(); ?>
<?php if ($rm_d): ?>
<footer>
  <div class="wrap big">
    <div>
      <a class="logo" href="<?= esc_url(rm_url('pl')) ?>" aria-label="GK Rolmax"></a>
      <p>Autoryzowany dealer New Holland.<br><?= rm_e(rm_opt('address')) ?><br>tel. <?= rm_e(rm_opt('sales1')) ?> · <?= rm_e(rm_opt('phone')) ?><br><?= rm_e(rm_opt('email')) ?></p>
      <div class="soc">
        <a href="<?= esc_url(rm_opt('facebook')) ?>" aria-label="Facebook"><svg><use href="#i-fb"/></svg></a>
        <a href="<?= esc_url(rm_opt('instagram')) ?>" aria-label="Instagram"><svg><use href="#i-ig"/></svg></a>
      </div>
    </div>
    <div><h5>Dział maszyn</h5><ul>
      <li><a href="<?= esc_url(rm_url('pl/maszyny')) ?>">Oferta maszyn</a></li>
      <li><a href="<?= esc_url(rm_url('pl/uslugi/finansowanie')) ?>">Finansowanie</a></li>
      <li><a href="<?= esc_url(rm_url('pl/uslugi/rolnictwo-precyzyjne')) ?>">Rolnictwo precyzyjne</a></li>
      <li><a href="https://cnhi-dealer-rolmax.webmag.io/rolnictwo-precyzyjne-2026/start">Blue &amp; you</a></li>
      <li><a href="<?= esc_url(rm_url('pl/kontakt/order')) ?>">Zapytaj o maszynę</a></li>
    </ul></div>
    <div><h5>Dział części</h5><ul>
      <li><a href="<?= esc_url(rm_url('pl/uslugi/czesci')) ?>">Części</a></li>
      <li><a href="<?= esc_url(rm_opt('shop')) ?>">Sklep online</a></li>
      <li><a href="<?= esc_url(rm_url('pl/promocje')) ?>">Promocje</a></li>
      <li><a href="<?= esc_url(rm_url('pl/uslugi/serwis')) ?>">Serwis</a></li>
      <li><a href="<?= esc_url(rm_url('pl/uslugi/likwidacja-szkod')) ?>">Likwidacja szkód</a></li>
    </ul></div>
    <div><h5>Firma</h5><ul>
      <li><a href="<?= esc_url(rm_url('pl/strony/o-nas')) ?>">O nas</a></li>
      <li><a href="<?= esc_url(rm_url('pl/aktualnosci')) ?>">Aktualności</a></li>
      <li><a href="<?= esc_url(rm_url('pl/galerie')) ?>">Galeria</a></li>
      <li><a href="<?= esc_url(rm_url('pl/strony/praca')) ?>">Praca</a></li>
      <li><a href="<?= esc_url(rm_url('pl/kontakt')) ?>">Kontakt</a></li>
      <li><a href="<?= esc_url(get_privacy_policy_url() ?: rm_url('pl/kontakt')) ?>">Polityka prywatności</a></li>
    </ul></div>
  </div>
  <div class="sign"><div class="wrap">
    <span>© Rolmax <?= esc_html(wp_date('Y')) ?>. Wszelkie prawa zastrzeżone.</span>
    <span class="j">Napędzani pasją · <?= rm_e(rm_opt('founded')) ?> — <?= rm_e(rm_opt('jubilee')) ?></span>
  </div></div>
</footer>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
