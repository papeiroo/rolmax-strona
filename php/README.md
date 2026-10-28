# Rolmax — motyw PHP (etap 1: akceptacja wyglądu)

Czysty PHP 8.1+, bez frameworka i bez WordPressa. Działa na każdym hostingu z PHP (LH.pl, home.pl, nazwa.pl).

## Struktura
```
app/config.php        treści: działy, wstążka maszyn, oddziały, aktualności (później: baza MySQL)
app/bootstrap.php     helpery (e, url, asset), router, renderowanie widoków
public/index.php      front controller — jedyny punkt wejścia
public/.htaccess      przyjazne adresy, cache, kompresja
public/assets/        css/app.css, js/app.js, img/logo.png
templates/layout.php  szkielet HTML
templates/partials/   ribbon (30-lecie), topbar, header (mega menu), footer, oddziały, aktualności…
templates/pages/      intro (wybór działu), maszyny, czesci, offer, category, page, 404
bin/export.php        eksport statycznego podglądu
```

## Adresy (jak na kisielagrotech.pl — prefiks działu)
`/` wybór działu · `/maszyny` · `/czesci` · `/maszyny/oferta` · `/maszyny/oferta/traktory` · `/{dzial}/finansowanie` · `/{dzial}/kontakt` …

## Uruchomienie lokalnie
```
php -S localhost:8000 -t public public/index.php
```

## Wgranie na serwer
Zawartość `public/` do katalogu domeny (np. `public_html`), a `app/` i `templates/` poziom wyżej
(poza publicznym katalogiem). Jeśli hosting nie pozwala wyjść poza `public_html`, wgraj całość
i ustaw katalog domeny na `public/`.

## Etap 2 (po akceptacji)
Baza MySQL + panel `/panel`: aktualności, promocje, komunikaty, godziny oddziałów, oferty pracy,
formularze z powiadomieniem e-mail do oddziału, konta pracowników z uprawnieniami.
