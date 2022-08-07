<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController {

    /**
     * @Route("/article", name="app_article")
     */
    public function article() {
        return $this->render('articles/article.html.twig');
    }

}