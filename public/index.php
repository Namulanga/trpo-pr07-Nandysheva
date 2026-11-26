<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Core/helpers.php';
require_once __DIR__ . '/../src/Core/View.php';
require_once __DIR__ . '/../src/Core/Router.php';
require_once __DIR__ . '/../src/Model/PageContent.php';
require_once __DIR__ . '/../src/Controller/HomeController.php';
require_once __DIR__ . '/../src/Controller/CatalogController.php';
require_once __DIR__ . '/../src/Controller/ErrorController.php';

$pages = new PageContent(__DIR__ . '/../data/pages.json');
$view = new View(__DIR__ . '/../views', ['storeName' => $pages->storeName()]);

$home = new HomeController($view, $pages);
$catalog = new CatalogController($view);
$errors = new ErrorController($view);

$router = new Router(
    [
        'GET /' => [$home, 'index'],
        'GET /catalog' => [$catalog, 'index'],
        'GET /about' => [$home, 'about'],
        'GET /missing' => [$errors, 'notFound'],
    ],
    [$errors, 'notFound']
);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
