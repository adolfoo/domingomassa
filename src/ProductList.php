<?php
declare(strict_types=1);

namespace Adolfoo\DomingoMassa;

final class ProductList
{
    const FILENAME = __DIR__ . '/../public/products.json';

    /**
     * @var array
     */
    private $products;

    public function __construct()
    {
        $this->products = \json_decode(file_get_contents(self::FILENAME), true);
    }

    public function get(int $id): array
    {
        $filtered = array_filter(
            $this->products,
            function (array $product) use ($id): bool {
                return $product['id'] === $id;
            }
        );

        $product = array_shift($filtered);

        if ($product === null) {
            throw new \OutOfRangeException('Product not found');
        }

        return $product;
    }
}
