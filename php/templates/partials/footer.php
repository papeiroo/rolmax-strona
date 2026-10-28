<footer>
  <div class="wrap big">
    <div>
      <a class="logo" href="<?= url('') ?>" aria-label="GK Rolmax"></a>
      <p><?= e(cfg('site.tagline')) ?>.<br><?= e(cfg('site.address')) ?><br>tel. 606 363 398 · <?= e(cfg('site.phone')) ?><br><?= e(cfg('site.email')) ?></p>
      <div class="soc">
        <a href="<?= e(cfg('site.facebook')) ?>" aria-label="Facebook"><svg><use href="#i-fb"/></svg></a>
        <a href="<?= e(cfg('site.instagram')) ?>" aria-label="Instagram"><svg><use href="#i-ig"/></svg></a>
      </div>
    </div>
    <div><h5>Dział maszyn</h5><ul>
      <li><a href="<?= url('maszyny/oferta') ?>">Oferta maszyn</a></li>
      <li><a href="<?= url('maszyny/finansowanie') ?>">Finansowanie</a></li>
      <li><a href="<?= url('maszyny/rolnictwo-precyzyjne') ?>">Rolnictwo precyzyjne</a></li>
      <li><a href="https://cnhi-dealer-rolmax.webmag.io/rolnictwo-precyzyjne-2026/start">Blue &amp; you</a></li>
      <li><a href="<?= url('maszyny/kontakt') ?>">Zapytaj o maszynę</a></li>
    </ul></div>
    <div><h5>Dział części</h5><ul>
      <li><a href="<?= url('czesci/czesci-zamowienia') ?>">Części</a></li>
      <li><a href="<?= e(cfg('site.shop')) ?>">Sklep online</a></li>
      <li><a href="<?= url('czesci/promocje') ?>">Promocje</a></li>
      <li><a href="<?= url('czesci/serwis') ?>">Serwis</a></li>
      <li><a href="<?= url('czesci/likwidacja-szkod') ?>">Likwidacja szkód</a></li>
    </ul></div>
    <div><h5>Firma</h5><ul>
      <li><a href="<?= url("$dept/o-firmie") ?>">O firmie</a></li>
      <li><a href="<?= url("$dept/aktualnosci") ?>">Aktualności</a></li>
      <li><a href="<?= url("$dept/galeria") ?>">Galeria</a></li>
      <li><a href="<?= url("$dept/kariera") ?>">Kariera</a></li>
      <li><a href="<?= url("$dept/kontakt") ?>">Kontakt</a></li>
      <li><?php $i = 0; foreach (cfg('site.langs') as $l => $h): ?><?= $i++ ? ' · ' : '' ?><a href="<?= e($h) ?>"><?= e($l) ?></a><?php endforeach; ?></li>
    </ul></div>
  </div>
  <div class="sign"><div class="wrap">
    <span>© Rolmax <?= date('Y') ?>. Wszelkie prawa zastrzeżone.</span>
    <span class="j">Napędzani pasją · <?= cfg('site.founded') ?> — <?= cfg('site.jubilee') ?></span>
  </div></div>
</footer>
