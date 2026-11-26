<?php
declare(strict_types=1);

final class HomeController
{
    public function __construct(
        private View $view,
        private PageContent $pages
    ) {
    }

    public function index(): void
    {
        $this->view->render('home', [
            'title' => 'Главная',
            'tagline' => $this->pages->tagline(),
            'benefits' => $this->pages->benefits(),
            'logoUrl' => '/assets/shop-logo.svg',
        ]);
    }

    public function about(): void
    {
        $this->view->render('about', [
            'title' => 'О магазине',
            'tagline' => $this->pages->tagline(),
            'benefits' => $this->pages->benefits(),
            'layers' => [
                ['Router', 'выбирает контроллер и метод по адресу запроса'],
                ['Controller', 'готовит данные и выбирает представление'],
                ['Model', 'читает данные из data/pages.json'],
                ['View', 'только выводит готовые данные в HTML'],
            ],
        ]);
    }
}
