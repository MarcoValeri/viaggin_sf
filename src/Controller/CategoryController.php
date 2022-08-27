<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController {

    #[Route('/categories', name: 'app_categories', priority: 1)]
    public function categories() {
        return $this->render('categories/categories.html.twig');
    }

    #[Route('/category/viaggi', name: 'app_category_viaggi')]
    public function categoryViaggi(ArticleRepository $articleRepository) {

        // Save all the articles into a variable
        $getArticles = $articleRepository->findAll();

        return $this->render('categories/viaggi.html.twig', [
            'getArticles' => $getArticles
        ]);
    }

    #[Route('/category/eventi', name: 'app_category_eventi')]
    public function categoryEventi(ArticleRepository $articleRepository) {

        // Save all the articles into a variable
        $getArticles = $articleRepository->findAll();

        return $this->render('categories/eventi.html.twig', [
            'getArticles' => $getArticles
        ]);
    }

    #[Route('/category/documenti', name: 'app_category_documenti')]
    public function categoryDocumenti(ArticleRepository $articleRepository) {

        // Save all the articles into a variable
        $getArticles = $articleRepository->findAll();

        return $this->render('categories/documenti.html.twig', [
            'getArticles' => $getArticles
        ]);
    }

    #[Route('/category/vivere-estero', name: 'app_category_estero')]
    public function categoryEstero(ArticleRepository $articleRepository) {

        // Save all the articles into a variable
        $getArticles = $articleRepository->findAll();

        return $this->render('categories/vivere-estero.html.twig', [
            'getArticles' => $getArticles
        ]);
    }

}