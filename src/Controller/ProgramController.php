<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;

#[Route('/program', name: 'program_')]
Class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
         $programs = $programRepository->findAll();

         return $this->render(
             'program/index.html.twig',
             ['programs' => $programs]
         );
    }
    
    #[Route('/show/{id}', name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
    $program = $programRepository->find($id);

    if (!$program) {
        throw $this->createNotFoundException('Program not found.');
    }

        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }


    #[Route('/program/{program}/seasons/{season}', name: 'season_show')]
    public function showSeason(Program $program, Season $season): Response 
    {

    if (!$program || !$season || !$program->getSeasons()->contains($season)) {
        throw $this->createNotFoundException('Program or Season not found.');
    }

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $season->getEpisodes(),
        ]);
    }
}