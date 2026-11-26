<?php
declare(strict_types=1);

final class ErrorController
{
    public function __construct(private View $view)
    {
    }

    public function notFound(): void
    {
        http_response_code(404);

        $this->view->render('404', ['title' => 'Страница не найдена']);
    }
}
