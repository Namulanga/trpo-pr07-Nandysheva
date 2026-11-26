<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Core/helpers.php';
require_once __DIR__ . '/../src/Core/View.php';
require_once __DIR__ . '/../src/Core/Router.php';

$view = new View(__DIR__ . '/../views', ['storeName' => 'Учебный магазин']);

$router = new Router(
    [
        'GET /' => fn() => $view->render('home', ['title' => 'Главная']),
    ],
    function (): void {
        http_response_code(404);
        echo 'Страница не найдена';
    }
);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
