# Rolmax — nowa strona rolmax.net.pl

Nowy wygląd strony Rolmax (autoryzowany dealer New Holland) z zachowaniem wszystkich dotychczasowych adresów.

| Folder | Co zawiera |
|---|---|
| `wordpress-motyw/rolmax/` | **Motyw WordPress** — docelowa wersja. Instalacja: [docs/INSTALACJA-WORDPRESS.md](docs/INSTALACJA-WORDPRESS.md) |
| `php/` | Ta sama strona w czystym PHP (bez WordPressa) — wersja alternatywna |
| `podglad/` | Statyczny podgląd HTML (do pokazania wyglądu, np. przez GitHub Pages) |
| `docs/` | Plan przełączenia bez utraty pozycji w Google, raport 283 starych adresów |

## Spakowanie motywu do wgrania
```
cd wordpress-motyw && zip -r rolmax.zip rolmax
```
Potem: WordPress → Wygląd → Motywy → Dodaj nowy → Wyślij motyw na serwer.

## Zgodność adresów
Lista dotychczasowych adresów: `wordpress-motyw/rolmax/data/legacy-urls.txt`.
Test wersji PHP: `php php/bin/check-urls.php` — każdy adres daje 200 albo 301, żadnego 404.
