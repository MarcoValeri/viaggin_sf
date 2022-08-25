<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    #[Route('/', name: 'app_home', priority: 1)]

    public function home(ArticleRepository $articleRepository) {

        // Save all the article into a variable
        $getArticles = $articleRepository->findAll();

        return $this->render('home.html.twig', [
            'getArticles'   => $getArticles
        ]);
    }

}