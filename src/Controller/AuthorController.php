<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController {

    #[Route('/autori', name: 'app_authors', priority: 1)]
    public function authors() {
        return $this->render('authors/authors.html.twig');
    }

    #[Route('/autore/marco-valeri', name: 'app_author', priority: 1)]
    public function author() {
        return $this->render('authors/author.html.twig');
    }

}