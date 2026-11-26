<?php
declare(strict_types=1);

final class CatalogController
{
    public function __construct(private View $view)
    {
    }

    public function index(): void
    {
        $products = [
            ['id' => 101, 'name' => 'Тетрадь в клетку', 'price' => 80],
            ['id' => 102, 'name' => 'Набор гелевых ручек', 'price' => 250],
            ['id' => 103, 'name' => 'Школьный рюкзак', 'price' => 2490],
        ];

        $this->view->render('catalog', [
            'title' => 'Каталог',
            'products' => $products,
        ]);
    }
}
