<?php
/**
 * Rdzeń aplikacji: helpery, routing i renderowanie widoków.
 * Bez frameworka — czysty PHP 8.1+, gotowy na hosting współdzielony (LH.pl, home.pl, nazwa.pl).
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__));
define('EXPORT', getenv('RM_EXPORT') === '1'); // tryb statycznego podglądu (php bin/export.php)

$GLOBALS['cfg'] = require ROOT . '/app/config.php';

function cfg(string $key, mixed $default = null): mixed
{
    $node = $GLOBALS['cfg'];
    foreach (explode('.', $key) as $part) {
        if (!is_array($node) || !array_key_exists($part, $node)) return $default;
        $node = $node[$part];
    }
    return $node;
}

/** Bezpieczne wypisanie tekstu w HTML. */
function e(?string $s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Bazowa ścieżka (działa także w podkatalogu, np. /nowa-strona/). */
function base_path(): string
{
    static $b = null;
    if ($b === null) {
        $b = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
    }
    return $b;
}

/** Dane z app/data/*.php (docelowo z bazy MySQL). */
function data(string $name): array
{
    static $c = [];
    return $c[$name] ??= require ROOT . "/app/data/$name.php";
}

/** Usługi: segment adresu /pl/uslugi/{seg} => klucz strony w config('pages'). */
/** Strony główne działów. */
const DEPT_SLUG = ['maszyny' => 'dzial-maszyn', 'czesci' => 'dzial-czesci'];

const SERVICE_MAP = ['czesci' => 'czesci-zamowienia', 'serwis' => 'serwis', 'finansowanie' => 'finansowanie', 'likwidacja-szkod' => 'likwidacja-szkod', 'rolnictwo-precyzyjne' => 'rolnictwo-precyzyjne'];

/**
 * Zamienia wewnętrzną ścieżkę szablonu ("maszyny/oferta/traktory", "czesci/serwis")
 * na publiczny adres zgodny z obecną strukturą rolmax.net.pl ("pl/maszyny/traktory", "pl/uslugi/serwis").
 * Dzięki temu Google widzi te same adresy co dziś.
 */
function public_path(string $p): string
{
    $p = trim($p, '/');
    if ($p === '') return 'pl';
    if ($p === 'pl' || str_starts_with($p, 'pl/')) return $p;
    $s = explode('/', $p);
    if (count($s) === 1) return 'pl/' . (DEPT_SLUG[$s[0]] ?? $s[0]);
    [$d, $k] = [$s[0], $s[1]];
    $rest = implode('/', array_slice($s, 2));
    $svc = array_flip(SERVICE_MAP);
    return match (true) {
        $k === 'oferta'        => rtrim('pl/maszyny/' . $rest, '/'),
        isset($svc[$k])        => 'pl/uslugi/' . $svc[$k],
        $k === 'uslugi'        => 'pl/uslugi',
        $k === 'aktualnosci'   => rtrim('pl/aktualnosci/' . $rest, '/'),
        $k === 'promocje'      => 'pl/promocje',
        $k === 'o-firmie'      => 'pl/strony/o-nas',
        $k === 'kariera'       => rtrim('pl/strony/praca/' . $rest, '/'),
        $k === 'galeria'       => rtrim('pl/galerie/' . $rest, '/'),
        $k === 'kontakt'       => rtrim('pl/kontakt/' . $rest, '/'),
        default                => 'pl/' . $p,
    };
}

/** Plik statycznego podglądu dla adresu publicznego. */
function export_file(string $pub, int $page = 1): string
{
    $pub = trim($pub, '/');
    $f = $pub === 'pl' ? 'index' : str_replace('/', '-', $pub);
    return $f . ($page > 1 ? "-p$page" : '') . '.html';
}

/** Link wewnętrzny (przyjmuje ścieżkę wewnętrzną lub publiczną, opcjonalnie ?page=N i #kotwicę). */
function url(string $path = ''): string
{
    if (preg_match('#^(https?:|mailto:|tel:|\#)#', $path)) return $path;
    $hash = $query = '';
    if (str_contains($path, '#')) [$path, $hash] = explode('#', $path, 2);
    if (str_contains($path, '?')) [$path, $query] = explode('?', $path, 2);
    $pub = public_path($path);
    parse_str($query, $q);
    $page = max(1, (int)($q['page'] ?? 1));
    if (EXPORT) return export_file($pub, $page) . ($hash !== '' ? "#$hash" : '');
    return base_path() . '/' . $pub . ($page > 1 ? "?page=$page" : '') . ($hash !== '' ? "#$hash" : '');
}

function canonical(string $pub, int $page = 1): string
{
    return rtrim(cfg('site.url'), '/') . '/' . trim($pub, '/') . ($page > 1 ? "?page=$page" : '');
}

function asset(string $file): string
{
    $f = ROOT . '/public/assets/' . $file;
    $v = is_file($f) ? substr(md5_file($f), 0, 8) : '1';
    return (EXPORT ? 'assets/' : base_path() . '/assets/') . $file . '?v=' . $v;
}

function tel(string $n): string { return 'tel:' . preg_replace('/\s+/', '', $n); }

/** Renderuje szablon z danymi. */
function view(string $tpl, array $data = []): string
{
    extract($data, EXTR_SKIP);
    ob_start();
    require ROOT . '/templates/' . $tpl . '.php';
    return (string)ob_get_clean();
}

function partial(string $name, array $data = []): void
{
    echo view('partials/' . $name, $data);
}

/** Czy bieżąca strona to podana ścieżka wewnętrzna (podświetlenie menu). */
function is_active(string $internal): bool
{
    return public_path($GLOBALS['route_pub'] ?? '') === public_path($internal);
}

/** Dział z pamięci przeglądarki (ciasteczko ustawiane na stronie działu), domyślnie maszyny. */
function remembered_dept(): string
{
    $d = $_COOKIE['rm_dzial'] ?? 'maszyny';
    return isset(cfg('departments')[$d]) ? $d : 'maszyny';
}

function humanize(string $slug): string
{
    return mb_strtoupper(mb_substr($t = str_replace('-', ' ', $slug), 0, 1)) . mb_substr($t, 1);
}

/**
 * Router publicznych adresów. Zwraca:
 *  ['view', szablon, dane, status]  |  ['redirect', cel, 301]  |  ['raw', treść, content-type]
 */
function resolve(string $path, array $query = []): array
{
    $raw  = $path;
    $path = trim($path, '/');
    $page = max(1, (int)($query['page'] ?? 1));
    $GLOBALS['route_pub'] = $path;
    $nf = fn() => ['view', 'pages/404', ['title' => 'Rolmax - Nie znaleziono', 'dept' => remembered_dept(), 'pub' => $path, 'noindex' => true], 404];

    // --- przekierowania 301 (zachowanie pozycji w Google) ---
    if ($path === '') return ['redirect', '/pl', 301];
    if (str_ends_with($raw, '/') && $path !== '') return ['redirect', '/' . $path . ($query ? '?' . http_build_query($query) : ''), 301];
    if (preg_match('#^(en|de|ru)(/(.*))?$#', $path, $m)) return ['redirect', '/pl' . (isset($m[3]) && $m[3] !== '' ? '/' . $m[3] : ''), 301];
    if (str_starts_with($path, 'pl/strony/https:')) return ['redirect', 'https://cnhi-dealer-rolmax.webmag.io/rolnictwo-precyzyjne-2026/start', 301];

    // --- pliki dla wyszukiwarek ---
    if ($path === 'sitemap.xml') return ['raw', sitemap_xml(), 'application/xml; charset=utf-8'];
    if ($path === 'robots.txt')  return ['raw', "User-agent: *\nAllow: /\nDisallow: /panel/\n\nSitemap: " . rtrim(cfg('site.url'), '/') . "/sitemap.xml\n", 'text/plain; charset=utf-8'];

    $s = explode('/', $path);
    if ($s[0] !== 'pl') return $nf();
    $s = array_slice($s, 1);
    $n = count($s);
    $T = fn(string $t) => 'Rolmax - ' . $t;
    $base = ['pub' => $path, 'page' => $page];

    if ($n === 0) return ['view', 'pages/intro', $base + ['title' => 'Rolmax - Autoryzowany Przedstawiciel New Holland', 'dept' => null, 'desc' => 'Rolmax — autoryzowany dealer New Holland od 1997 roku. Maszyny rolnicze, części, serwis i finansowanie. Świdnik, Miączyn, Rudnik, Białka.'], 200];

    // nowe strony główne działów
    if ($n === 1 && ($d = array_search($s[0], DEPT_SLUG, true)) !== false) {
        $m = [1 => $d];
        if (!EXPORT && !headers_sent()) setcookie('rm_dzial', $m[1], ['expires' => time() + 31536000, 'path' => '/', 'samesite' => 'Lax']);
        $_COOKIE['rm_dzial'] = $m[1];
        return ['view', 'pages/' . $m[1], $base + ['title' => $T(cfg("departments.{$m[1]}.label")), 'dept' => $m[1]], 200];
    }

    // /pl/maszyny[/kategoria[/model]]
    if ($s[0] === 'maszyny' && $n <= 3) {
        $dept = 'maszyny';
        if ($n === 1) return ['view', 'pages/offer', $base + ['title' => $T('Oferta'), 'dept' => $dept], 200];
        $cat = cfg('machines.' . $s[1]);
        if (!$cat) return $nf();
        if ($n === 2) return ['view', 'pages/category', $base + ['title' => $T($cat[1]), 'dept' => $dept, 'slug' => $s[1], 'cat' => $cat, 'desc' => $cat[3]], 200];
        foreach (cfg('models.' . $s[1], []) as [$mName, $mSlug]) {
            if ($mSlug === $s[2]) return ['view', 'pages/model', $base + ['title' => $T($mName), 'dept' => $dept, 'slug' => $s[1], 'cat' => $cat, 'model' => [$mName, $mSlug]], 200];
        }
        return $nf();
    }

    // /pl/uslugi[/usluga]
    if ($s[0] === 'uslugi' && $n <= 2) {
        if ($n === 1) return ['view', 'pages/services', $base + ['title' => $T('Usługi'), 'dept' => remembered_dept()], 200];
        $key = SERVICE_MAP[$s[1]] ?? null;
        if (!$key) return $nf();
        $pg = cfg("pages.$key");
        $dept = in_array($s[1], ['finansowanie', 'rolnictwo-precyzyjne'], true) ? 'maszyny' : 'czesci';
        return ['view', 'pages/page', $base + ['title' => $T($pg[0]), 'dept' => $dept, 'slug' => $key, 'page_' => $pg, 'desc' => $pg[2]], 200];
    }

    // /pl/aktualnosci[/wpis]
    if ($s[0] === 'aktualnosci' && $n <= 2) {
        $pg = cfg('pages.aktualnosci');
        if ($n === 1) return ['view', 'pages/page', $base + ['title' => $T('Aktualności') . ($page > 1 ? " - strona $page" : ''), 'dept' => remembered_dept(), 'slug' => 'aktualnosci', 'page_' => $pg], 200];
        foreach (data('news') as $item) if ($item[0] === $s[1]) return ['view', 'pages/article', $base + ['title' => $T($item[2]), 'dept' => remembered_dept(), 'item' => $item], 200];
        return $nf();
    }

    // /pl/galerie[/galeria]
    if ($s[0] === 'galerie' && $n <= 2) {
        $pg = cfg('pages.galeria');
        if ($n === 1) return ['view', 'pages/page', $base + ['title' => $T('Galeria') . ($page > 1 ? " - strona $page" : ''), 'dept' => remembered_dept(), 'slug' => 'galeria', 'page_' => $pg], 200];
        foreach (data('galleries') as $g) if ($g[0] === $s[1]) return ['view', 'pages/gallery', $base + ['title' => $T($g[1]), 'dept' => remembered_dept(), 'item' => $g], 200];
        return $nf();
    }

    // /pl/strony/o-nas, /pl/strony/praca[/oferta]
    if ($s[0] === 'strony' && $n >= 2 && $n <= 3) {
        if ($s[1] === 'o-nas' && $n === 2) { $pg = cfg('pages.o-firmie'); return ['view', 'pages/page', $base + ['title' => $T('O nas'), 'dept' => remembered_dept(), 'slug' => 'o-firmie', 'page_' => $pg, 'desc' => $pg[2]], 200]; }
        if ($s[1] === 'praca') {
            $pg = cfg('pages.kariera');
            if ($n === 2) return ['view', 'pages/page', $base + ['title' => $T('Praca'), 'dept' => remembered_dept(), 'slug' => 'kariera', 'page_' => $pg], 200];
            foreach (data('jobs') as $j) if ($j[0] === $s[2]) return ['view', 'pages/job', $base + ['title' => $T($j[1] . ' - ' . $j[2]), 'dept' => remembered_dept(), 'item' => $j], 200];
        }
        return $nf();
    }

    if ($s[0] === 'promocje' && $n === 1) { $pg = cfg('pages.promocje'); return ['view', 'pages/page', $base + ['title' => $T('Promocje'), 'dept' => 'czesci', 'slug' => 'promocje', 'page_' => $pg], 200]; }

    // /pl/kontakt[/order|/support]
    if ($s[0] === 'kontakt' && $n <= 2) {
        $variant = $s[1] ?? null;
        if ($variant !== null && !in_array($variant, ['order', 'support'], true)) return $nf();
        $pg = cfg('pages.kontakt');
        $t = ['order' => 'Zapytanie o maszynę', 'support' => 'Zgłoszenie serwisowe'][$variant] ?? 'Kontakt';
        $dept = $variant === 'order' ? 'maszyny' : ($variant === 'support' ? 'czesci' : remembered_dept());
        return ['view', 'pages/page', $base + ['title' => $T($t), 'dept' => $dept, 'slug' => 'kontakt', 'variant' => $variant, 'page_' => [$t, $pg[1], $pg[2], $pg[3]]], 200];
    }
    return $nf();
}

/** Wszystkie indeksowalne adresy publiczne: [ścieżka, numer strony listy]. */
function all_routes(): array
{
    $r = [['pl', 1], ['pl/dzial-maszyn', 1], ['pl/dzial-czesci', 1], ['pl/maszyny', 1], ['pl/uslugi', 1], ['pl/promocje', 1],
          ['pl/strony/o-nas', 1], ['pl/strony/praca', 1], ['pl/kontakt', 1], ['pl/kontakt/order', 1], ['pl/kontakt/support', 1]];
    foreach (cfg('machines') as $c => $_) {
        $r[] = ["pl/maszyny/$c", 1];
        foreach (cfg("models.$c", []) as [, $m]) $r[] = ["pl/maszyny/$c/$m", 1];
    }
    foreach (SERVICE_MAP as $k => $_) $r[] = ["pl/uslugi/$k", 1];
    for ($i = 1, $n = (int)ceil(count(data('news')) / PER_PAGE); $i <= $n; $i++) $r[] = ['pl/aktualnosci', $i];
    foreach (data('news') as $x) $r[] = ['pl/aktualnosci/' . $x[0], 1];
    for ($i = 1, $n = (int)ceil(count(data('galleries')) / PER_PAGE); $i <= $n; $i++) $r[] = ['pl/galerie', $i];
    foreach (data('galleries') as $x) $r[] = ['pl/galerie/' . $x[0], 1];
    foreach (data('jobs') as $x) $r[] = ['pl/strony/praca/' . $x[0], 1];
    return $r;
}
const PER_PAGE = 12;

function sitemap_xml(): string
{
    $x = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach (all_routes() as [$p, $pg]) $x .= '  <url><loc>' . e(canonical($p, $pg)) . "</loc></url>\n";
    return $x . "</urlset>\n";
}

/** Renderuje adres. Zwraca [treść, status, nagłówki]. */
function render(string $path, array $query = []): array
{
    $r = resolve($path, $query);
    if ($r[0] === 'redirect') return ['', $r[2], ['Location' => $r[1]]];
    if ($r[0] === 'raw') return [$r[1], 200, ['Content-Type' => $r[2]]];
    [, $tpl, $data, $status] = $r;
    $body = view($tpl, $data);
    return [view('layout', $data + ['body' => $body]), $status, ['Content-Type' => 'text/html; charset=utf-8']];
}

/** Miniatura modelu: zdjęcie z assets/img/maszyny/{slug}.* albo liniowy rysunek kategorii. */
function model_thumb(string $slug, string $icon): string
{
    foreach (['webp', 'png', 'jpg'] as $ext) {
        if (is_file(ROOT . "/public/assets/img/maszyny/$slug.$ext")) {
            return '<img src="' . e(asset("img/maszyny/$slug.$ext")) . '" alt="" loading="lazy" decoding="async">';
        }
    }
    return '<svg class="mi" aria-hidden="true"><use href="#' . e($icon) . '"/></svg>';
}
