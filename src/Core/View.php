<?php
declare(strict_types=1);

final class View
{
    public function __construct(
        private string $viewsDir,
        private array $shared = []
    ) {
    }

    public function render(string $template, array $data = []): void
    {
        $file = $this->viewsDir . '/' . $template . '.php';

        if (!is_file($file)) {
            throw new RuntimeException('Представление не найдено: ' . $template);
        }

        extract($data + $this->shared);

        ob_start();
        require $file;
        $content = ob_get_clean();

        require $this->viewsDir . '/layout.php';
    }
}
