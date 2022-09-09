<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Subcategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubcategoryFixtures extends Fixture
{
    public const SUBCATEGORY = [
        'surgelés' => [
            'Légumes surgelés',
            'Potages & soupes',
            'Herbes & sauces',
            'Poissons & crustacés',
            'Préparations pomme de terre',
            'Pains & viennoiseries',
            'Snacks & apéro',
            'Entrées',
            'Pizzas & quiches',
            'Plats préparés',
            'Glaces & desserts',
        ],
        'produits frais' => [
            'Fruits & Légumes',
            'Crèmerie',
            'Boucherie',
            'Charcuterie',
            'Boulangerie & pâtisserie',
            'Poissonnerie & sushi',
            'Végétarien & vegan',
            'Traiteur & plats cuisinés',
            'Apéritif',
        ],
        'épicerie' => [
            'Pâtes, riz & féculents',
            'Petit déjeuner',
            'Biscottes & pains grillés',
            'Desserts, sucres & farines',
            'Biscuits & gâteaux',
            'Chocolat',
            'Confiserie',
            'Potages & croutons',
            'Chips & apéritif',
            'Conserves',
            'Cuisine du monde',
            'Sauces, condiments & aides culinaires ',
        ],
        'boissons' => [
            'Eaux',
            'Laits & boissons végétales',
            'Boissons chaudes',
            'Jus de fruits & légumes',
            'Sodas',
            'Sirops',
            'Apéritifs & alcools',
            'Bières',
            'Vins',
            'Mousseux & champagnes',
        ],
        'soins et hygiène' => [
            'Corps',
            'Cheveux',
            'Visage',
            'Hygiène buccale',
            'Hygiène',
            'Hygiène masculine',
            'Parapharmacie',
        ],
        'entretien' => [
            'Papier toilette, essuie-tout & mouchoirs',
            'Lessives',
            'Soins du linge',
            'Produits vaisselle',
            'Nettoyants maison',
            'Désodorisant & recharges',
            'Accessoires ménagers',
            'Accessoires maison',
            'Insecticides ',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SUBCATEGORY as $subcategoryArray) {
            $category = $this->getReference('category_' . array_search($subcategoryArray, self::SUBCATEGORY));

            foreach ($subcategoryArray as $subcategoryInput) {
                $subcategory = new Subcategory();
                $subcategory
                    ->setCategory($category)
                    ->setSubcategory($subcategoryInput);
                $manager->persist($subcategory);

                $this->addReference('subcategory_' . str_replace(' ', '_', $subcategoryInput), $subcategory);
            }
        }

        $manager->flush();
    }
}
