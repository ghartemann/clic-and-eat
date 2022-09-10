<?php

namespace App\DataFixtures;

use App\Entity\GroceryList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GroceryListFixtures extends Fixture implements DependentFixtureInterface
{
    public const GROCERIES = [
        [
            'ingredient' => 'riz arborio',
            'shop' => 'supermarché',
            'quantity' => 2,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::GROCERIES as $listInput) {
            $list = new GroceryList();

            $list
                ->addIngredient($this->getReference('ingredient_' . str_replace(' ', '_', $listInput['ingredient'])))
                ->setQuantity($listInput['quantity'])
                ->setPriority(true)
                ->setShop($this->getReference('shop_' . str_replace(' ', '_', $listInput['shop'])));

            $manager->persist($list);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return
            [
                IngredientFixtures::class,
                ShopFixtures::class,
            ];
    }
}
