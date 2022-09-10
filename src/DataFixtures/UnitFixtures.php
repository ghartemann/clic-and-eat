<?php

namespace App\DataFixtures;

use App\Entity\Unit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UnitFixtures extends Fixture
{
    public const UNITS = [
        [
            'name' => 'g',
            'fullname' => 'gramme',
        ],
        [
            'name' => 'mg',
            'fullname' => 'milligramme',
        ],
        [
            'name' => 'kg',
            'fullname' => 'kilogramme',
        ],
        [
            'name' => 'mL',
            'fullname' => 'millilitre',
        ],
        [
            'name' => 'cL',
            'fullname' => 'centilitre',
        ],
        [
            'name' => 'L',
            'fullname' => 'litre',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::UNITS as $inputUnit) {
            $unit = new Unit();
            $unit
                ->setName($inputUnit['name'])
                ->setFullname($inputUnit['fullname']);
            $manager->persist($unit);

            $this->addReference('unit_' . $inputUnit['name'], $unit);
        }
        
        $manager->flush();
    }
}
