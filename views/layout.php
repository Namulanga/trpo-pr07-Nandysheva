<?php
$storeName = $storeName ?? 'Мой магазин';
$title = $title ?? '';
$content = $content ?? '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? e($title) . ' — ' : '' ?><?= e($storeName) ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="/"><?= e($storeName) ?></a>
        <nav class="nav" aria-label="Основная навигация">
            <a href="/">Главная</a>
            <a href="/catalog">Каталог</a>
            <a href="/about">О магазине</a>
        </nav>
    </div>
</header>

<main class="container">
    <?= $content ?>
</main>

<footer class="site-footer">
    <div class="container">© <?= date('Y') ?> <?= e($storeName) ?>. Учебный проект ТРПО.</div>
</footer>
</body>
</html>
