<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Core/helpers.php';
require_once __DIR__ . '/../src/Core/View.php';
require_once __DIR__ . '/../src/Core/Router.php';
require_once __DIR__ . '/../src/Model/PageContent.php';
require_once __DIR__ . '/../src/Controller/HomeController.php';

$pages = new PageContent(__DIR__ . '/../data/pages.json');
$view = new View(__DIR__ . '/../views', ['storeName' => $pages->storeName()]);

$home = new HomeController($view, $pages);

$router = new Router(
    [
        'GET /' => [$home, 'index'],
        'GET /about' => [$home, 'about'],
    ],
    function (): void {
        http_response_code(404);
        echo 'Страница не найдена';
    }
);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
