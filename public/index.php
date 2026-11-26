<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Core/Router.php';

header('Content-Type: text/plain; charset=utf-8');

$router = new Router(
    [
        'GET /' => fn() => print("Главная\n"),
        'GET /catalog' => fn() => print("Каталог\n"),
    ],
    function (): void {
        http_response_code(404);
        echo "Страница не найдена\n";
    }
);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);