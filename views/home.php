<section class="hero">
    <div class="hero-text">
        <h1><?= e($storeName) ?></h1>
        <p class="lead"><?= e($tagline) ?></p>
        <a class="button" href="/catalog">Открыть каталог</a>
    </div>
    <img class="hero-image" src="<?= e($logoUrl) ?>" alt="Логотип: <?= e($storeName) ?>" width="450" height="260">
</section>

<section aria-labelledby="benefits-title">
    <h2 id="benefits-title">Преимущества</h2>
    <?php if ($benefits === []): ?>
        <p class="empty">Список преимуществ пока пуст.</p>
    <?php else: ?>
        <ul class="benefit-list">
            <?php foreach ($benefits as $benefit): ?>
                <li class="card"><?= e($benefit) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>
