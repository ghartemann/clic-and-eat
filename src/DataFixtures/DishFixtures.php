<?php

namespace App\DataFixtures;

use App\Entity\Dish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DishFixtures extends Fixture
{
    public const DISHES = [
        'apéro',
        'dessert',
        'plat',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DISHES as $dishInput) {
            $dish = new Dish();

            $dish->setName($dishInput);

            $this->addReference('dish_' . $dishInput, $dish);

            $manager->persist($dish);
        }

        $manager->flush();
    }
}
