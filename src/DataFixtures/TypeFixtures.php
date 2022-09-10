<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public const TYPES = [
        'salé',
        'sucré',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TYPES as $typeInput) {
            $type = new Type();

            $type->setType($typeInput);

            $this->addReference('type_' . $typeInput, $type);

            $manager->persist($type);
        }

        $manager->flush();
    }
}
