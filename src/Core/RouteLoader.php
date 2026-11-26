<?php
declare(strict_types=1);

final class RouteLoader
{
    private const COLUMNS = ['method', 'path', 'controller', 'action'];

    public function __construct(private string $file)
    {
    }

    /**
     * @param array<string, object> $controllers
     * @return array<string, array{0: object, 1: string}>
     */
    public function load(array $controllers): array
    {
        if (!is_file($this->file)) {
            throw new RuntimeException('Файл не найден: ' . basename($this->file));
        }

        $lines = file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false || $lines === []) {
            throw new RuntimeException('Файл ' . basename($this->file) . ' пуст');
        }

        $lines[0] = ltrim($lines[0], "\xEF\xBB\xBF");
        $header = array_map('trim', str_getcsv(array_shift($lines), ';', '"', ''));

        if (array_diff(self::COLUMNS, $header) !== []) {
            throw new RuntimeException('В ' . basename($this->file) . ' должны быть колонки: ' . implode(', ', self::COLUMNS));
        }

        $routes = [];

        foreach ($lines as $number => $line) {
            $cells = array_map('trim', str_getcsv($line, ';', '"', ''));

            if (count($cells) !== count($header)) {
                throw new RuntimeException('Неверное число колонок в строке ' . ($number + 2) . ' файла ' . basename($this->file));
            }

            $route = array_combine($header, $cells);
            $key = strtoupper($route['method']) . ' ' . $route['path'];
            $class = $route['controller'];
            $action = $route['action'];

            if (!isset($controllers[$class])) {
                throw new RuntimeException("Маршрут $key: контроллер $class не подключён");
            }

            if (!method_exists($controllers[$class], $action)) {
                throw new RuntimeException("Маршрут $key: у $class нет метода $action()");
            }

            $routes[$key] = [$controllers[$class], $action];
        }

        return $routes;
    }
}
