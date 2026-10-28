# Rolmax — plan przełączenia na nowy wygląd bez utraty pozycji w Google

## 1. Google Search Console (GSC) — jak zdobyć dostęp
1. Zapytaj szefa / KODIGO, czy rolmax.net.pl jest już w GSC. Jeśli tak — właściciel konta dodaje Cię:
   **Ustawienia → Użytkownicy i uprawnienia → Dodaj użytkownika → Twój Gmail → uprawnienia „Pełne”.**
2. Jeśli nikt nie ma GSC — dodaj usługę samodzielnie: https://search.google.com/search-console
   → **Dodaj usługę → „Domena” → rolmax.net.pl** → Google poda rekord TXT.
   Rekord TXT dodaje osoba z dostępem do panelu **KEI.pl** (DNS domeny jest w KEI, patrz pkt 3).
   Weryfikacja przez DNS obejmuje całą domenę (http/https, z www i bez) i przetrwa zmianę strony.
3. Po weryfikacji pobierz (Skuteczność → ostatnie 16 mies. → Eksportuj):
   - **Strony** — które adresy dają kliknięcia (te muszą działać bezwzględnie),
   - **Zapytania** — frazy, na które Rolmax jest wysoko (zostaw je w tytułach i nagłówkach).
4. Pierwsze dane GSC zbiera od dnia weryfikacji — zrób to **teraz**, minimum 2–4 tygodnie przed przełączeniem.

## 2. Lista obecnych adresów — ZROBIONE
- Strona nie ma sitemap.xml ani robots.txt — zebrano adresy przejściem po stronie.
- `app/data/legacy-urls.txt` — 283 adresy: strony główne, 9 kategorii, 54 modele, 5 usług,
  141 aktualności (archiwum 2010–2026), 45 galerii, 3 oferty pracy, kontakt/order/support, wersje EN/DE/RU.
- `app/data/raport-migracji.csv` — wynik testu: **270 × 200 (ten sam adres)**, **13 × 301**, **0 × 404**.
- Uzupełnić z eksportu bazy KODIGO (lub z GSC): ok. 15–20 najstarszych aktualności (2013–2015)
  nie było widocznych na listach — po dopisaniu do `app/data/news.php` uruchomić ponownie test:
  `php bin/check-urls.php > app/data/raport-migracji.csv`

## 3. Hosting i domena — USTALONE
| Co | Wynik | Znaczenie |
|---|---|---|
| Serwery DNS | ns1.kei.pl, ns2.kei.pl | Domena zarządzana w panelu **KEI.pl** |
| Serwer strony | 94.152.13.128 (host128.e-kei.pl) | Strona stoi na hostingu **KEI.pl** |
| Poczta (MX) | rolmax.net.pl (ten sam serwer) | **Poczta @rolmax.net.pl jest na tym samym serwerze** |
| Sklep | rolmax-sklep.pl → 212.91.26.121 | Inny serwer, przełączenie go nie dotyczy |

Do ustalenia: **kto jest właścicielem konta w KEI** — Rolmax (faktury z KEI w księgowości) czy KODIGO.
Rejestrator domeny: sprawdzić na https://www.dns.pl/whois (wpisać rolmax.net.pl).

⚠️ Poczta: nie zmieniać serwerów DNS ani rekordów MX. Najbezpieczniej wgrać nową stronę
na to samo konto KEI (podmiana plików), poczta działa dalej bez zmian.

## 4. Nowa strona na starych adresach — ZROBIONE
- Router obsługuje dokładnie obecne adresy `/pl/...` (maszyny, modele, usługi, aktualności, galerie, praca, kontakt).
- Tytuły stron w tym samym formacie co dziś: `Rolmax - T8 GENESIS™`.
- Przekierowania 301: `/` → `/pl`, `/en|de|ru/...` → `/pl/...` (wersje językowe miały polską treść — duplikaty),
  końcowy „/” → bez „/”, błędny link `/pl/strony/https:/...` → strona Blue & you.
- Nowe adresy (dodatkowe, nie zastępują starych): `/pl/dzial-maszyn`, `/pl/dzial-czesci`, `/pl/promocje`.
- `sitemap.xml` (284 adresy), `robots.txt`, `canonical`, Open Graph, dane strukturalne firmy i 4 oddziałów.

## 5. Dzień przełączenia (checklista)
1. Kopia zapasowa obecnej strony i bazy (KEI → Kopie zapasowe / FTP).
2. Wgranie nowej strony do katalogu domeny w KEI, `public/` jako katalog domeny.
3. Test: `php bin/check-urls.php` na serwerze + ręcznie 10 najważniejszych adresów z GSC.
4. GSC → **Mapy witryn → dodaj `sitemap.xml`**.
5. GSC → Sprawdzanie adresu URL → strona główna i 3 kluczowe → „Poproś o zindeksowanie”.
6. Przez 4 tygodnie co tydzień: GSC → Strony → błędy 404 → dopisać brakujące adresy / przekierowania.
