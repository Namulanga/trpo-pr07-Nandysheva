<?php
declare(strict_types=1);

// Запуск: php tests/routes_check.php
// Сервер должен быть запущен: php -S localhost:8000 -t public
$baseUrl = $argv[1] ?? 'http://localhost:8000';
$lines = file(__DIR__ . '/../data/routes.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$lines[0] = ltrim($lines[0], "\xEF\xBB\xBF");
array_shift($lines);

$cases = [];
foreach ($lines as $line) {
    [$method, $path, $controller] = array_map('trim', str_getcsv($line, ';', '"', ''));
    $cases[] = [$method, $path, $controller === 'ErrorController' ? 404 : 200];
}
$cases[] = ['GET', '/no-such-page', 404];

$failed = 0;

foreach ($cases as [$method, $path, $expected]) {
    $context = stream_context_create(['http' => ['method' => $method, 'ignore_errors' => true]]);
    @file_get_contents($baseUrl . $path, false, $context);

    if (!isset($http_response_header[0]) || !preg_match('/\s(\d{3})\s/', $http_response_header[0], $m)) {
        echo "ОШИБКА  $method $path: сервер не отвечает\n";
        exit(1);
    }

    $status = (int) $m[1];
    $ok = $status === $expected;
    $failed += $ok ? 0 : 1;
    echo ($ok ? 'OK      ' : 'ОШИБКА  ') . "$method $path: ожидали $expected, получили $status\n";
}

exit($failed === 0 ? 0 : 1);
