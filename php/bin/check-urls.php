<?php
/**
 * Test migracji: każdy dotychczasowy adres rolmax.net.pl przepuszczany przez nowy router.
 * Wynik: 200 (strona istnieje pod tym samym adresem) lub 301 (przekierowanie) — żadnego 404.
 * php bin/check-urls.php > raport.csv
 */
declare(strict_types=1);
$_SERVER['SCRIPT_NAME'] = '/index.php';
require dirname(__DIR__) . '/app/bootstrap.php';
$bad = 0;
echo "stary_adres;status;nowy_adres\n";
foreach (file(ROOT . '/app/data/legacy-urls.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $u) {
    $parts = parse_url($u); parse_str($parts['query'] ?? '', $q);
    $target = $u; $hops = 0;
    do {
        $r = resolve(rawurldecode($parts['path'] ?? '/'), $q);
        if ($r[0] !== 'redirect') break;
        $target = $r[1]; $hops++;
        if (str_starts_with($target, 'http')) break;
        $parts = parse_url($target); parse_str($parts['query'] ?? '', $q);
    } while ($hops < 5);
    $status = $r[0] === 'redirect' && !str_starts_with($target, 'http') ? 'PĘTLA' : ($hops ? '301' : (string)($r[3] ?? 200));
    if (!in_array($status, ['200', '301'], true)) $bad++;
    echo "$u;$status;" . ($hops ? $target : $u) . "\n";
}
fwrite(STDERR, $bad ? "UWAGA: $bad adresów bez strony\n" : "OK: wszystkie adresy działają\n");
exit($bad ? 1 : 0);
