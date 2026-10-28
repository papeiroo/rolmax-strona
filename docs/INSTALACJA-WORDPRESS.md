# Motyw Rolmax dla WordPressa — instalacja

## 1. Wgranie
1. Panel WordPressa → **Wygląd → Motywy → Dodaj nowy → Wyślij motyw na serwer** → wybierz `rolmax.zip` → **Zainstaluj** → **Włącz**.
2. Przy pierwszym włączeniu motyw sam tworzy całą strukturę z adresami dotychczasowej strony:
   strony (/pl, /pl/uslugi/…, /pl/strony/o-nas, /pl/kontakt/…), 9 kategorii i 54 modele maszyn,
   4 oddziały z godzinami i telefonami, 141 aktualności, 45 galerii i 3 oferty pracy.
   Ponowne uruchomienie (bez nadpisywania istniejących treści): **Narzędzia → Rolmax: import startowy**.
3. Motyw ustawia **Ustawienia → Bezpośrednie odnośniki** na `/pl/aktualnosci/%postname%` — nie zmieniaj tego,
   bo adresy aktualności muszą być takie jak dziś.

## 2. Gdzie co się edytuje
| Co | Gdzie w panelu |
|---|---|
| Aktualności i promocje | **Wpisy** (promocje = kategoria „Promocje”, trafiają też na /pl/promocje) |
| Modele maszyn, zdjęcia, opisy | **Maszyny** — zdjęcie = „Obrazek wyróżniający”; kolejność = „Atrybuty → Kolejność” |
| Kategorie maszyn (wstążka „Oferta”) | **Maszyny → Kategorie** — kod (T, CX…), podpis, rysunek, kolejność |
| Oddziały: adresy, godziny, telefony, e-maile | **Oddziały** |
| Telefony w pasku, wstążka 30-lecia, komunikat działu części, sklep, FB/IG | **Wygląd → Dostosuj → Rolmax** |
| Treść podstron (usługi, o nas, kontakt) | **Strony** |
| Galerie | **Galerie** — w treści blok „Galeria” |
| Oferty pracy | **Praca** |
| Zdjęcie w tle strony działu | **Strony → Dział maszyn / Dział części → Obrazek wyróżniający** |

## 3. Zalecane wtyczki
- **Contact Form 7** — formularze. Utwórz formularz, wklej jego shortcode do stron
  „Zapytanie o maszynę” i „Zgłoszenie serwisowe” (Strony → Kontakt → podstrony). Motyw ostyluje go automatycznie.
- **Yoast SEO** lub **Rank Math** — opcjonalnie; motyw sam wyłącza wtedy swoje znaczniki SEO.
- **UpdraftPlus** — kopie zapasowe.
- **WP Mail SMTP** — żeby e-maile z formularzy dochodziły ze skrzynki @rolmax.net.pl.

## 4. Adresy i Google
- Wszystkie dotychczasowe adresy (`data/legacy-urls.txt`, 283 szt.) działają pod tym samym adresem lub mają przekierowanie 301
  (`/` → `/pl`, `/en|de|ru/…` → `/pl/…`, błędny link Blue & you).
- Mapa strony: `/wp-sitemap.xml` (WordPress) — dodaj ją w Google Search Console.
- Lista aktualności zachowuje stronicowanie `?page=2` jak na starej stronie.

## 5. Wymagania
WordPress 6.4+ (testowane na 7.1.4), PHP 8.1+.
