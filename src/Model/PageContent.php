<?php
declare(strict_types=1);

final class PageContent
{
    private string $storeName;
    private string $tagline;
    /** @var string[] */
    private array $benefits;

    public function __construct(string $file)
    {
        if (!is_file($file)) {
            throw new RuntimeException('Файл не найден: ' . basename($file));
        }

        try {
            $data = json_decode((string) file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException('Файл ' . basename($file) . ' содержит неверный JSON: ' . $e->getMessage());
        }

        $storeName = $data['store_name'] ?? null;
        $tagline = $data['tagline'] ?? null;
        $benefits = $data['benefits'] ?? null;

        if (!is_string($storeName) || trim($storeName) === '' || !is_string($tagline) || !is_array($benefits)) {
            throw new RuntimeException('В ' . basename($file) . ' должны быть поля store_name, tagline и benefits');
        }

        $this->storeName = trim($storeName);
        $this->tagline = trim($tagline);
        $this->benefits = array_values(array_filter($benefits, 'is_string'));
    }

    public function storeName(): string
    {
        return $this->storeName;
    }

    public function tagline(): string
    {
        return $this->tagline;
    }

    /** @return string[] */
    public function benefits(): array
    {
        return $this->benefits;
    }
}
