<?php

declare(strict_types=1);

namespace App\Twig;

use App\Entity\Product;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ProductExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_minimal_price_for_product', [$this, 'getMinimalPriceForProduct']),
        ];
    }

    public function getMinimalPriceForProduct(Product $product): ?int
    {
        $minPrice = null;
        foreach ($product->getVariants() as $variant) {
            if ($minPrice === null || $variant->getPrice() < $minPrice) {
                $minPrice = $variant->getPrice();
            }
        }
        return $minPrice;
    }
}
