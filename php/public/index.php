<?php
declare(strict_types=1);
require dirname(__DIR__) . '/app/bootstrap.php';

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Serwer wbudowany PHP (php -S): pliki statyczne obsługuje sam
if (PHP_SAPI === 'cli-server') {
    if ($uri !== '/' && is_file(__DIR__ . $uri)) return false;
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}
$path = substr(rawurldecode($uri), strlen(base_path()));

[$body, $status, $headers] = render($path, $_GET);
http_response_code($status);
foreach ($headers as $k => $v) header("$k: $v");
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
echo $body;
