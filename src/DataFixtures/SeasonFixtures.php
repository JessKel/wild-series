<?php

namespace App\DataFixtures;

use App\Entity\Season;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        [
        'number' => 1,
        'year' => 2010,
        'description'=> 'Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, 
        un groupe d\'hommes et de femmes mené par l\'officier Rick Grimes tente de survivre. Ensemble, ils vont devoir 
        tant bien que mal faire face à ce nouveau monde.',
        'program' => ['title' => 'Walking Dead'],
        'affiche' => 'build/images/WDseason1.jpg',
        ],
        [
        'number' => 2,
        'year' => 2011,
        'description'=> 'Cette saison suit les aventures de Rick Grimes et son groupe, depuis leur rencontre avec une horde 
        de « rôdeurs » sur une autoroute, entraînant la disparition de Sophia Peletier, jusqu\'à leur fuite de la ferme des Greene 
        qui est envahie par les « rôdeurs ».',
        'program' => ['title' => 'Walking Dead'],
        'affiche' => 'build/images/WDseason2.jpg',
        ],
        [
        'number' => 1,
        'year' => 2016,
        'description'=> 'En 1983, à Hawkins dans l\'Indiana, Will Byers disparaît de son domicile. Ses amis se lancent alors dans une 
        recherche semée d\'embûches pour le retrouver. Pendant leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite.',
        'program' => ['title' => 'Stranger Things'],
        'affiche' => 'build/images/STseason1.jpg',
        ],
        [
        'number' => 2,
        'year' => 2017,
        'description'=> 'Un an s’est écoulé depuis que Will a été sauvé et que Onze a disparu. Le calme semble être revenu dans la petite 
        ville d’Hawkins où Will et ses amis Mike, Lucas et Dustin tentent de reprendre le cours de leurs vies. Mais les habitants d’Hawkins 
        vont à nouveau être plongés dans l’horreur lorsque Will, qui n’est plus tout à fait le même depuis son retour de l’Upside Down, 
        reçoit des visions sombres et terrifiantes. De leur côté, le shérif Hopper et Joyce luttent ensemble contre cette nouvelle menace, 
        tandis que Nancy et Jonathan unissent leurs forces pour rétablir la vérité et obtenir justice pour Barbara.',
        'program' => ['title' => 'Stranger Things'],
        'affiche' => 'build/images/STseason2.jpg',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $seasonData) {
            $season = new Season();
            $season->setNumber($seasonData['number']);
            $season->setYear($seasonData['year']);
            $season->setDescription($seasonData['description']);
            $season->setProgram($this->getReference($seasonData['program']['title']));
            $season->setAffiche($seasonData['affiche']);


            $this->addReference('season_' . $seasonData['number'] . '_' . $seasonData['program']['title'], $season);
            $manager->persist($season);
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