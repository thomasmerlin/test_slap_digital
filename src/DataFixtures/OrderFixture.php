<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\ProductVariant;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $users = $manager->getRepository(User::class)->findAll();
        $variants = $manager->getRepository(ProductVariant::class)->findAll();

        foreach ($users as $user) {
            for ($i = 0; $i < rand(50, 80); $i++) {
                $order = new Order();
                $order->setUser($user);

                // Add random variants to the order
                for ($j = 0; $j < rand(1, 3); $j++) {
                    $variant = $variants[array_rand($variants)];
                    $order->getVariants()->add($variant);
                }

                $manager->persist($order);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
            ProductFixture::class,
        ];
    }
}