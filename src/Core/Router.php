<?php
declare(strict_types=1);

final class Router
{
    public function __construct(
        private array $routes,
        private Closure|array $notFound
    ) {
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = $this->normalizePath($uri);
        $key = strtoupper($method) . ' ' . $path;

        $handler = $this->routes[$key] ?? $this->notFound;
        $handler();
    }

    private function normalizePath(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH);

        if (!is_string($path) || $path === '') {
            return '/';
        }

        return $path === '/' ? '/' : rtrim($path, '/');
    }
}
