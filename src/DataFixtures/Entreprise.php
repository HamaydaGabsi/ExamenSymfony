<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Entreprise extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i = 0 ; $i< 300; $i++) {
            $entr = new \App\Entity\Entreprise();
            $entr->setDesignation($faker->company);
            $manager->persist($entr);
        }
        $manager->flush();

    }
}
