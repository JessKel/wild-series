<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger)
    {

    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $program) {
            for($i=1; $i<=SeasonFixtures::SEASONS; $i++){
                for ($episodeNumber = 1; $episodeNumber <= 10; $episodeNumber++) {
                    $episode = new Episode();
                    $episode->setSeason($this->getReference('program_' . $program['title']. '_season'. $i));
                    $episode->setTitle($faker->realText(10));
                    $episode->setNumber($episodeNumber);
                    $episode->setSynopsis($faker->realText(200));
                    $episode->setDuration($faker->numberBetween(30, 50));

                    $slug = $this->slugger->slug($episodeNumber);
                    $episode->setSlug($slug);

                    $manager->persist($episode);
                }
            }
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