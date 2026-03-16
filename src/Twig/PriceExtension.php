<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PriceExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('format_price', [$this, 'formatPrice']),
        ];
    }

    public function formatPrice(?int $price): string
    {
        if ($price === null) {
            return '';
        }

        $euros = $price / 100;

        return number_format($euros, 2, ',', ' ') . '€';
    }
}