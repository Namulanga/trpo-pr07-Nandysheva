<?php
$message = $message ?? 'Произошла неизвестная ошибка.';
?>

<section class="state state-error">
    <h1>Не удалось загрузить страницу</h1>

    <p><?= e($message) ?></p>

    <p>
        Проверьте файлы в папке
        <code>data</code>
        и обновите страницу.
    </p>

    <a class="button" href="/">На главную</a>
</section>