<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Episode;
use App\DataFixtures\SeasonFixtures;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => 'Passé décomposé',
            'number' => 1,
            'synopsis' => 'Rick Grimes, shérif, est blessé à la suite d\'une course-poursuite. Il se retrouve dans le coma. 
            Cependant, lorsqu\'il se réveille dans l\'hôpital, il ne découvre que désolation et cadavres.',
            'season' => 1,
        ],
        [
            'title' => 'Guts',
            'number' => 2,
            'synopsis' => 'A la fin de l\'épisode 1, nous avions quitté Rick Grimes, réfugié dans un tank et totalement encerclé 
            par des centaines de zombies, dans la ville d\'Atlanta, qu\'il croyait être le dernier lieu pouvant proposer sécurité 
            et nourriture face à l\'épidémie de zombification.',
            'season' => 1,
        ],
        [
            'title' => 'Konsekans',
            'number' => 1,
            'synopsis' => 'Il y a six semaines, la République Civique conduit une horde incroyablement grande à Omaha et détruit les murs, 
            laissant la laissant envahir la ville et faisant la même chose à la colonie du campus quelques jours plus tard; Kublek dit à 
            Frank Newton que ce n’est que le début de leurs plans...',
            'season' => 2,
        ],

    ];
    
    public function load(ObjectManager $manager): void
    {
            foreach (self::EPISODES as $episodeData) {
                $episode = new Episode();
                $episode->setTitle($episodeData['title']);
                $episode->setNumber($episodeData['number']);
                $episode->setSynopsis($episodeData['synopsis']);
                $episode->setSeason($this->getReference('season_' . $episodeData['season'] . '_Walking Dead'));

            if (!$episode) {
               throw new \Exception('Episode "'. $episodeData['number'] .'" not found.');
            }
            $manager->persist($episode);
            }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
            ProgramFixtures::class,
        ];
    }
}
