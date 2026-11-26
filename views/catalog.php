<h1>Каталог</h1>

<?php if ($products === []): ?>
    <p class="empty">Товаров пока нет. Загляните позже.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Цена</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= (int) $product['id'] ?></td>
                    <td><?= e($product['name']) ?></td>
                    <td><?= number_format((float) $product['price'], 0, ',', ' ') ?> ₽</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
