<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'Walking dead',
            'synopsis' => 'Des zombies envahissent la terre',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Stranger Things',
            'synopsis' => 'Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse, 
            des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette.',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'You',
            'synopsis' =>  'Un libraire devient peu à peu obsédée par une jeune femme aspirante écrivain. Un coup de cœur 
            qui vira à l\'obsession dangereuse et effrayante, tandis qu\'il met tout en œuvre pour se rapprocher d\'elle.',
            'category' => 'category_Dramatique', 
        ],
        [
            'title' => 'Ahsoka',
            'synopsis' => 'Au lendemain de la chute de l\'Empire, l\'ex-chevalière Jedi Ahsoka Tano enquête sur une menace latente 
            qui pourrait bouleverser le fragile équilibre d’une galaxie encore vulnérable...',
            'category' => 'category_SF',
        ],
        [
            'title' => 'Rebel Moon',
            'synopsis' => 'Dans une colonie pacifique aux confins de la galaxie se retrouve bientôt menacée par les armées du 
            tyrannique régent Balisarius. Ils envoient une jeune femme mystérieuse chercher des guerriers sur les planètes voisines 
            pour les aider à s\'y installer.',
            'category' => 'category_SF',
        ],
        [
            'title' => 'The Witcher',
            'synopsis' => 'Le sorceleur Geralt, un chasseur de monstres mutant, se bat pour trouver sa place dans un monde où les humains 
            se révèlent souvent plus vicieux que les bêtes.',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'The Crown',
            'synopsis' => 'Au fil des décennies, des intrigues personnelles, des romances, et des rivalités politiques, la reine Élisabeth II 
            continue de régner malgré les difficultés.The Crown présente la vie de la souveraine du Royaume-Uni, Élisabeth II, de son mariage 
            en 1947 jusqu\'à nos jours, durant six saisons, chacune couvrant une décennie du règne de la souveraine britannique.',
            'category' => 'category_Historique',
        ],
        [
            'title' => 'Wednesday',
            'synopsis' => 'Wednesday est l\'ainée de Gomez et de Morticia. Elle va dans un lycée où elle n\'hésite pas à semer le trouble 
            quand on la cherche. Après une énième éjection et un procès pour tentative de meurtre, ses parents l\'inscrivent 
            à l\'académie où ils se sont rencontrés : Nevermore.',
            'category' => 'category_Horreur',
        ],
    ];
    
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setCategory($this->getReference($programData['category']));
            
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}

