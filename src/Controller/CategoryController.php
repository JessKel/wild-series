<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use App\Form\CategoryType;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/category', name: 'category_')]
Class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
         $categories = $categoryRepository->findAll();

         return $this->render(
             'category/index.html.twig',
             ['categories' => $categories]
         );
    }
    
    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager) : Response
    {
    $category = new Category();
    $form = $this->createForm(CategoryType::class, $category);
    $form->handleRequest($request);

    if ($form->isSubmitted()) {
        $entityManager->persist($category);
        $entityManager->flush();            

        // Redirect to categories list
        return $this->redirectToRoute('category_index');
    }

    // Render the form
    return $this->render('category/new.html.twig', [
        'form' => $form,
    ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(CategoryRepository $categoryRepository, ProgramRepository $programRepository, string $categoryName): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        // Vérifie si la catégorie existe, sinon retourner une erreur 404
        if (!$category) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Récupérer jusqu'à 3 programmes appartenant à cette catégorie, ordonnés par ID décroissant
        $program = $programRepository->findBy(
            ['category' => $category],
            ['id' => 'DESC'],
            3
        );

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'program' => $program,
        ]);
    }
}
