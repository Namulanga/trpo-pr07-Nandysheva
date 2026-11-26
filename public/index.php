<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Core/helpers.php';
require_once __DIR__ . '/../src/Core/View.php';
require_once __DIR__ . '/../src/Core/Router.php';
require_once __DIR__ . '/../src/Core/RouteLoader.php';
require_once __DIR__ . '/../src/Model/PageContent.php';
require_once __DIR__ . '/../src/Controller/HomeController.php';
require_once __DIR__ . '/../src/Controller/CatalogController.php';
require_once __DIR__ . '/../src/Controller/ErrorController.php';

$rootDir = dirname(__DIR__);

try {
    $pages = new PageContent($rootDir . '/data/pages.json');
    $view = new View($rootDir . '/views', ['storeName' => $pages->storeName()]);

    $home = new HomeController($view, $pages);
    $catalog = new CatalogController($view);
    $errors = new ErrorController($view);

    $routes = (new RouteLoader($rootDir . '/data/routes.csv'))->load([
        'HomeController' => $home,
        'CatalogController' => $catalog,
        'ErrorController' => $errors,
    ]);

    $router = new Router($routes, [$errors, 'notFound']);
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (RuntimeException $e) {
    http_response_code(500);

    $errorView = new View($rootDir . '/views', ['storeName' => 'Учебный магазин']);
    $errorView->render('error', [
        'title' => 'Ошибка',
        'message' => $e->getMessage(),
    ]);
}
