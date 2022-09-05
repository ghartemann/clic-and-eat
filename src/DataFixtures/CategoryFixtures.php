<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY = [
        'surgelés',
        'produits frais',
        'épicerie',
        'boissons',
        'soins et hygiène',
        'entretien',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORY as $categoryInput) {
            $category = new Category();
            $category->setCategory($categoryInput);
            $manager->persist($category);
            
            $this->addReference('category_' . $categoryInput, $category);
        }

        $manager->flush();
    }
}
