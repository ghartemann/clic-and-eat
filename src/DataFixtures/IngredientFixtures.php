<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture implements DependentFixtureInterface
{
    public const INGREDIENTS = [
        [
            'name' => 'riz arborio',
            'subcategory' => 'Pâtes, riz & féculents',
        ],
        [
            'name' => 'mozzarella',
            'subcategory' => 'Crèmerie',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::INGREDIENTS as $ingredientInput) {
            $ingredient = new Ingredient();

            $ingredient
                ->setName($ingredientInput['name'])
                ->setSubcategory(
                    $this->getReference(
                        'subcategory_' .
                        str_replace(' ', '_', $ingredientInput['subcategory'])
                    )
                );

            $this->addReference('ingredient_' . str_replace(' ', '_', $ingredientInput['name']), $ingredient);

            $manager->persist($ingredient);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return
            [
                SubcategoryFixtures::class,
            ];
    }
}
