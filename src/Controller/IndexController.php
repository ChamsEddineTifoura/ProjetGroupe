<?php

namespace App\Controller;

use App\Entity\Film;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ManagerRegistry $doctrine): Response {
        // Récupératiuon de ArticleRepository
        $repository = $doctrine->getRepository(Film::class);

        // Récupération de tous les articles
        $films = $repository->findAll();

        return $this->render('index/index.html.twig', [
            'films' => $films,
        ]);
    }
}
