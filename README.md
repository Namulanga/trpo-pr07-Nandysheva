# Практическая работа 7. PHP MVC интернет-магазин

Учебный интернет-магазин на чистом PHP, построенный по архитектуре MVC.

## Описание проекта

Приложение использует единую точку входа `public/index.php`. Все запросы проходят через `Router`, который выбирает контроллер и действие по таблице маршрутов `data/routes.csv`.

В проекте реализованы:
- главная страница;
- каталог с тестовыми товарами;
- страница «О магазине»;
- собственная страница 404;
- общий шаблон `layout.php`;
- загрузка текстового содержимого из `data/pages.json`;
- безопасный вывод текста с помощью функции `e()`;
- обработка ошибок загрузки данных с HTTP-статусом 500;
- адаптивные стили и состояния страниц.

## Технологии
- PHP 8.1+
- HTML
- CSS
- Git

## Структура проекта

```text
public/
  index.php
  style.css
  assets/
    shop-logo.svg
src/
  Core/
    Router.php
    RouteLoader.php
    View.php
    helpers.php
  Controller/
    HomeController.php
    CatalogController.php
    ErrorController.php
  Model/
    PageContent.php
views/
  layout.php
  home.php
  about.php
  catalog.php
  error.php
data/
  routes.csv
  pages.json
tests/
```

## Запуск

Из корневой папки проекта выполните:

```bash
php -S localhost:8000 -t public
```

Затем откройте в браузере:

- [Главная](http://localhost:8000/)
- [Каталог](http://localhost:8000/catalog)
- [О магазине](http://localhost:8000/about)
- [Проверка 404](http://localhost:8000/missing)

Для остановки сервера нажмите `Ctrl+C`.

## Маршруты

| Метод | URL | Результат |
|---|---|---|
| GET | `/` | Главная страница |
| GET | `/catalog` | Каталог с тестовыми товарами |
| GET | `/about` | Страница «О магазине» |
| GET | `/missing` | Страница 404 |

Неизвестные адреса также обрабатываются как 404.

## Проверка

Проверить маршруты можно командой:

```bash
php tests/routes_check.php
```

Для проверки HTTP-статуса неизвестного адреса:

```bash
curl -i http://localhost:8000/abc
```

## Архитектура MVC

- **Model** — работает с данными из `pages.json`.
- **View** — формирует HTML из шаблонов.
- **Controller** — подготавливает данные и выбирает представление.
- **Router** — сопоставляет HTTP-метод и путь с обработчиком.

## Git

Проект создан в рамках практической работы 7. История изменений сохраняется с помощью Git.
