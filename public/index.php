<?php
declare(strict_types=1);

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

header('Content-Type: text/plain; charset=utf-8');
echo "Метод: $method\nПуть: $path\n";