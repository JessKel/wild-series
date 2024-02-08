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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Service\ProgramDuration;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


#[Route('/program', name: 'program_')]
Class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', ['programs' => $programs]);
    }  

    
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $entityManager, Request $request, ProgramRepository $programRepository,MailerInterface $mailer, SluggerInterface $slugger): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $entityManager->persist($program);
            $entityManager->flush();
            
            $this->addFlash('success', 'The new program has been created');
            
            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to('jessica.keller68@gmail.com')
                ->subject('Une nouvelle série vient d\'être publiée !')
                ->html($this->renderView('Program/newProgramEmail.html.twig', ['program' => $program]));

            $mailer->send($email);

            return $this->redirectToRoute('program_index');
        }
        return $this->render('program/new.html.twig', ['form' => $form, 'program' => $program,]);
    }


    #[Route('/show/{programSlug}', methods: ['GET'],  name: 'show')]
    public function show(
        #[MapEntity(mapping: ['programSlug' => 'slug'])] Program $program, ProgramDuration $programDuration): Response
        {
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'programDuration' => $programDuration->calculate($program)
        ]);
    }

    #[Route('/program/{programSlug}/seasons/{seasonSlug}', name: 'season_show')]
    public function showSeason(
        #[MapEntity(mapping: ['programSlug' => 'slug'])] Program $program, 
        #[MapEntity(mapping: ['seasonSlug' => 'slug'])] Season $season
        ): Response {
        
        if (!$program) {
            throw $this->createNotFoundException(
            'No program with id : '. 'program_id'.' found in program\'s table.'
                );
            }
    
            if (!$season) {
                throw $this->createNotFoundException(
                    'No seaons with id : ' . 'season_id' .' found in season\'s table.'
                );
            }
        if ($season->getProgram()!= $program) {
            throw $this->createNotFoundException(
                'This season doesn\'t belong to this program'
            );
        }

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $season->getEpisodes(),
        ]);
    }

    #[Route('/program/{programSlug}/season/{seasonSlug}/episode/{episodeSlug}', methods: ["GET"], requirements:['programID' => '\d+', 'seasonID' => '\d+', 'episodeID' => '\d+'], name: 'episode_show')]
    public function showEpisode(
        #[MapEntity(mapping: ['programSlug' => 'slug'])] Program $program, 
        #[MapEntity(mapping: ['seasonSlug' => 'slug'])] Season $season,
        #[MapEntity(mapping: ['episodeSlug' => 'slug'])] Episode $episode
    ): Response {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);
    }

    #[Route('/{slug}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Program $program, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $entityManager->persist($program);
            $entityManager->flush();

            return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('program/edit.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Program $program, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'. $program->getId(), $request->request->get('_token'))) {
            $entityManager->remove($program);
            $entityManager->flush();
        }
        $this->addFlash('danger', 'The program has been deleted');

        return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
    }
}