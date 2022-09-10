<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShopFixtures extends Fixture
{
    public const SHOPS = [
        'supermarché',
        'magasin bio',
        'marché',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SHOPS as $shopInput) {
            $shop = new Shop();
            $shop
                ->setName($shopInput);
            $manager->persist($shop);

            $this->addReference('shop_' . str_replace(' ', '_', $shopInput), $shop);
        }

        $manager->flush();
    }
}
