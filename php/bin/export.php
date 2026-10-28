<?php
/** Eksport statycznego podglądu: php bin/export.php <katalog> */
declare(strict_types=1);
putenv('RM_EXPORT=1');
$_SERVER['SCRIPT_NAME'] = '/index.php';
require dirname(__DIR__) . '/app/bootstrap.php';
$out = $argv[1] ?? ROOT . '/build';
@mkdir($out, 0777, true);
$n = 0;
foreach (all_routes() as [$p, $pg]) {
    [$html] = render('/' . $p, $pg > 1 ? ['page' => $pg] : []);
    file_put_contents($out . '/' . export_file($p, $pg), $html);
    $n++;
}
echo "$n stron\n";
