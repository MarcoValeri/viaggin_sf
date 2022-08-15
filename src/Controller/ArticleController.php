<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController {

    /**
     * @Route("/{slug}", name="app_article")
     */
    public function article(ArticleRepository $articleRepository, string $slug) {

        $getArticles = $articleRepository->findAll();

        return $this->render('articles/article.html.twig', [
            'getArticles'   => $getArticles,
            'slug'          => $slug
        ]);
    }

}