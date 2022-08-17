<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController {

    #[Route('/categories', name: 'app_categories', priority: 1)]
    public function categories() {
        return $this->render('categories/categories.html.twig');
    }

    #[Route('/category/viaggi', name: 'app_category_viaggi')]
    public function categoryViaggi() {
        return $this->render('categories/viaggi.html.twig');
    }

    #[Route('/category/eventi', name: 'app_category_eventi')]
    public function categoryEventi() {
        return $this->render('categories/eventi.html.twig');
    }

    #[Route('/category/documenti', name: 'app_category_documenti')]
    public function categoryDocumenti() {
        return $this->render('categories/documenti.html.twig');
    }

    #[Route('/category/vivere-estero', name: 'app_category_estero')]
    public function categoryEstero() {
        return $this->render('categories/vivere-estero.html.twig');
    }

}