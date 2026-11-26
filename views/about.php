<?php
$storeName = $storeName ?? 'Мой магазин';
$tagline = $tagline ?? '';
$benefits = $benefits ?? [];
$layers = $layers ?? [];
?>

<h1>О магазине</h1>
<p class="lead"><?= e($storeName) ?> — <?= e($tagline) ?>.</p>

<h2>Преимущества</h2>
<ul>
    <?php foreach ($benefits as $benefit): ?>
        <li><?= e($benefit) ?></li>
    <?php endforeach; ?>
</ul>

<h2>Из чего состоит приложение</h2>
<table class="table">
    <thead>
        <tr><th>Слой</th><th>Что делает</th></tr>
    </thead>
    <tbody>
        <?php foreach ($layers as [$name, $role]): ?>
            <tr>
                <td><?= e($name) ?></td>
                <td><?= e($role) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
