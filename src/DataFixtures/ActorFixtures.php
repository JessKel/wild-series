<?php
namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {   
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor);
            for ($j = 0; $j < 3; $j++) {
                $actor->addProgram($this->getReference('Program_' . rand(0, 2)));
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}