<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\ProductVariant;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $product = new Product();
            $product->setName('Produit ' . $i);
            $product->setImage('https://fastly.picsum.photos/id/39/200/200.jpg?hmac=Q0ovKQ8Rm51WeQ057IqUXwL_1r7V0S8VtWwdZNpXW7E');
            $productCode = "200" . $i;
            $product->setCode($productCode);

            for ($j = 1; $j <= 5; $j++) {
                $variant = new ProductVariant();
                $variant->setName('Variant ' . $j . ' du Produit ' . $i);
                $variant->setPrice(rand(100, 10000));
                $variant->setStock(rand(1, 100));
                $variant->setProduct($product);
                $variant->setCode($productCode . '.' . $j);
                $manager->persist($variant);
            }

            $manager->persist($product);
        }
        $manager->flush();
    }


}
