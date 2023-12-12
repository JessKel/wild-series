<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger)
    {

    }

    public const PROGRAMS = [
        [
            'title' => 'Walking Dead',
            'synopsis' => 'Des zombies envahissent la terre',
            'category' => 'category_Action',
            'year' => 2010,
            'country'=> 'US',
            'poster' => 'build/images/walkingdead.jpg',
        ],
        [
            'title' => 'Stranger Things',
            'synopsis' => 'Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse, 
            des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette.',
            'category' => 'category_Fantastique',
            'year' => 2015,
            'country'=> 'US',
            'poster' => 'build/images/strangerthings.jpeg',
        ],
        [
            'title' => 'You',
            'synopsis' =>  'Un libraire devient peu à peu obsédée par une jeune femme aspirante écrivain. Un coup de cœur 
            qui vira à l\'obsession dangereuse et effrayante, tandis qu\'il met tout en œuvre pour se rapprocher d\'elle.',
            'category' => 'category_Dramatique',
            'year' => 2018,
            'country'=> 'US',
            'poster' => 'build/images/you.jpg',
        ],
        [
            'title' => 'Ahsoka',
            'synopsis' => 'Au lendemain de la chute de l\'Empire, l\'ex-chevalière Jedi Ahsoka Tano enquête sur une menace latente 
            qui pourrait bouleverser le fragile équilibre d’une galaxie encore vulnérable...',
            'category' => 'category_SF',
            'year' => 2023,
            'country'=> 'US',
            'poster' => 'build/images/ahsoka.jpg',
        ],
        [
            'title' => 'Rebel Moon',
            'synopsis' => 'Dans une colonie pacifique aux confins de la galaxie se retrouve bientôt menacée par les armées du 
            tyrannique régent Balisarius. Ils envoient une jeune femme mystérieuse chercher des guerriers sur les planètes voisines 
            pour les aider à s\'y installer.',
            'category' => 'category_SF',
            'year' => 2023,
            'country'=> 'US',
            'poster' => 'build/images/rebelmoon.webp',
        ],
        [
            'title' => 'The Witcher',
            'synopsis' => 'Le sorceleur Geralt, un chasseur de monstres mutant, se bat pour trouver sa place dans un monde où les humains 
            se révèlent souvent plus vicieux que les bêtes.',
            'category' => 'category_Fantastique',
            'year' => 2019,
            'country'=> 'US',
            'poster' => 'build/images/witcher.jpg',
        ],
        [
            'title' => 'The Crown',
            'synopsis' => 'Au fil des décennies, des intrigues personnelles, des romances, et des rivalités politiques, la reine Élisabeth II 
            continue de régner malgré les difficultés.The Crown présente la vie de la souveraine du Royaume-Uni, Élisabeth II, de son mariage 
            en 1947 jusqu\'à nos jours, durant six saisons, chacune couvrant une décennie du règne de la souveraine britannique.',
            'category' => 'category_Historique',
            'year' => 2016,
            'country'=> 'US',
            'poster' => 'build/images/crown.webp',
        ],
        [
            'title' => 'Wednesday',
            'synopsis' => 'Wednesday est l\'ainée de Gomez et de Morticia. Elle va dans un lycée où elle n\'hésite pas à semer le trouble 
            quand on la cherche. Après une énième éjection et un procès pour tentative de meurtre, ses parents l\'inscrivent 
            à l\'académie où ils se sont rencontrés : Nevermore.',
            'category' => 'category_Horreur',
            'year' => 2022,
            'country'=> 'US',
            'poster' => 'build/images/wednesday.jpg',
        ],
        [
            'title' => 'Les Thunderman',
            'synopsis' => 'Les jumeaux Phoebe et Max, ainsi que toute leur famille les Thunderman, ont des super pouvoirs. Ils ont emménagé 
            dans la ville d\'Hiddenville, en Floride, pour vivre une vie normale et garder secret leurs capacités.',
            'category' => 'category_Jeunesse',
            'year' => 2021,
            'country'=> 'US',
            'poster' => 'build/images/thunderman.jpeg',
        ],
        [
            'title' => 'The Last Kingdom',
            'synopsis' => 'Au IXème siècle, l\'Angleterre, séparée en de nombreux royaumes, est envahie par les Vikings menés par le Roi Alfred. 
            Alors que le royaume de Wessex est le seul à résister, Uhtred doit choisir entre son pays natal et le peuple qui l\'a élevé.',
            'category' => 'category_Aventure',
            'year' => 2015,
            'country'=> 'GB',
            'poster' => 'build/images/lastKingdom.jpeg',
        ],
        [
            'title' => 'Arcane',
            'synopsis' => 'Au milieu du conflit entre les villes jumelles de Piltover et Zaun, deux soeurs se battent dans les camps opposés 
            d\'une guerre entre technologies magiques et convictions incompatibles.',
            'category' => 'category_Animation',
            'year' => 2021,
            'country'=> 'US-FR',
            'poster' => 'build/images/arcane.webp',
        ],
        [
            'title' => 'Secrets de champions',
            'synopsis' => 'Sept athlètes emblématiques lèvent le voile sur les moments déterminants de leur carrière où ils ont touché la grandeur. 
            Un nouvel éclairage sur des légendes du sport bien connues.',
            'category' => 'category_Sport',
            'year' => 2020,
            'country'=> 'US',
            'poster' => 'build/images/secretchampions.jpeg',
        ],
        [
            'title' => 'Game of Thrones',
            'synopsis' => 'Neuf familles nobles rivalisent pour le contrôle du Trône de Fer dans les sept royaumes de Westeros. Pendant ce temps, 
            des anciennes créatures mythiques oubliées reviennent pour faire des ravages.',
            'category' => 'category_Fantasy',
            'year' => 2011,
            'country'=> 'US',
            'poster' => 'build/images/got.jpg',
        ],
        [
            'title' => 'House of the Dragon',
            'synopsis' => 'L\'histoire de la guerre civile des Targaryen, 200 ans avant les événements du "Trône de fer". Les partisans d\'Aegon 
            s\'opposent à ceux de sa demi-soeur Rhaenyra pour le trône de Viserys I, leur défunt père.',
            'category' => 'category_Fantasy',
            'year' => 2022,
            'country'=> 'US',
            'poster' => 'build/images/houseOfDragon.jpeg',
        ],
        [
            'title' => 'Le Seigneur des Anneaux : Les Anneaux de Pouvoir',
            'synopsis' => 'En passant par les profondeurs des Monts Brumeux et le royaume de Númenor, les héros affrontent la réapparition tant 
            redoutée du mal en Terre du Milieu et créent des héritages qui vivront longtemps après qu\'ils soient partis.',
            'category' => 'category_Fantasy',
            'year' => 2022,
            'country'=> 'US',
            'poster' => 'build/images/lesAnneauxPouvoir.jpeg',
        ],
    ];
    
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setCategory($this->getReference($programData['category']));
            $program->setYear($programData['year']);
            $program->setCountry($programData['country']);
            $program->setPoster($programData['poster']);

            $slug = $this->slugger->slug($programData['title']);
            $program->setSlug($slug);

            $this->addReference('program_' . $programData['title'], $program);
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