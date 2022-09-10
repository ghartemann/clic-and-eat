<?php

namespace App\DataFixtures;

use App\Entity\IngredientRecipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IngredientRecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public const INGREDIENTRECIPE = [
        [
            'ingredient' => 'riz arborio',
            'quantity' => 300,
            'unit' => 'g',
        ],
        [
            'ingredient' => 'mozzarella',
            'quantity' => '200',
            'unit' => 'g',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::INGREDIENTRECIPE as $ingredientRecipeInput) {
            $ingredientRecipe = new IngredientRecipe();

            $ingredientRecipe
                ->setIngredient($this->getReference('ingredient_' . str_replace(' ', '_', $ingredientRecipeInput['ingredient'])))
                ->setQuantity($ingredientRecipeInput['quantity'])
                ->setUnit($this->getReference('unit_' . $ingredientRecipeInput['unit']));

            $this->addReference('ingredientRecipe_' . str_replace(' ', '_', $ingredientRecipeInput['ingredient']), $ingredientRecipe);

            $manager->persist($ingredientRecipe);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return
            [
                SubcategoryFixtures::class,
                UnitFixtures::class,
            ];
    }
}
