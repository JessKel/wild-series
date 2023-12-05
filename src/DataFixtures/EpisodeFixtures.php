<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Episode;
use App\DataFixtures\SeasonFixtures;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

            for ($i = 0; $i <= 500; $i++) {

                $episode = new Episode();
                $episode->setTitle($faker->words (7, true));
                $episode->setNumber($i);
                $episode->setSynopsis($faker->words (20, true));
                $episode->setSeason($this->getReference('season_' . ($i % 50)));

                $manager->persist($episode);
                }
            $manager->flush();
    }


    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            ProgramFixtures::class,
            SeasonFixtures::class,
        ];
    }
}