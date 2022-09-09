<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public const RECIPES = [
        [
            'type' => 'Salé',
            'title' => 'Arancini',
            'picture' => 'https://kissmychef.com/wp-content/uploads/2021/01/arancini.png',
            'cookingTime' => 120,
            'prepTime' => 30,
            'restTime' => 0,
            'ingredients' => ['Riz arborio', 'Mozzarella'],
            'steps' => ['Faire le risotto', 'Faire des boules', 'Paner les boules'],
            'youtube' => '',
            'url' => '',
            'doc' => '',
            'book' => 'Cucina',
            'page' => 140,
            'vg' => true,
            'servings' => 4,
            'notes' => 'C\'est bon',
            'dish_type' => 'Plat',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::RECIPES as $recipeInput) {
            $recipe = new Recipe();

            $recipe
                ->setType($this->getReference('type_' . $recipeInput['type']))
                ->setTitle($recipeInput['title'])
                ->setPicture($recipeInput['picture'])
                ->setCookingTime($recipeInput['cookingTime'])
                ->setPrepTime($recipeInput['prepTime'])
                ->setRestTime($recipeInput['restTime'])
                ->setSteps($recipeInput['steps'])
                ->setYoutube($recipeInput['youtube'])
                ->setUrl($recipeInput['url'])
                ->setDoc($recipeInput['doc'])
                ->setBook($recipeInput['book'])
                ->setPage($recipeInput['page'])
                ->setVg($recipeInput['vg'])
                ->setServings($recipeInput['servings'])
                ->setNotes($recipeInput['notes'])
                ->setDishType($this->getReference('dish_' . $recipeInput['dish_type']));

            foreach ($recipeInput['ingredients'] as $recipeIngredient) {
                $recipe->addRecipeIngredient($this->getReference('ingredient_' . str_replace(' ', '_', $recipeIngredient)));
            }

            $manager->persist($recipe);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return
            [
                TypeFixtures::class,
            ];
    }
}
