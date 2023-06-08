<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController {

    #[Route('/autori/tutti-gli-autori', name: 'app_authors', priority: 1)]
    public function authors(AuthorRepository $authorRepository, ArticleRepository $articleRepository) {

        // Save authors into a variable
        $getAllAuthors = $authorRepository->findAll();

        return $this->render('authors/authors.html.twig', [
            'getAllAuthors'  => $getAllAuthors
        ]);
    }

    #[Route('/autori/{slug}', name: 'app_author', priority: 1)]
    public function author(AuthorRepository $authorRepository, ArticleRepository $articleRepository, string $slug) {

        $author = $authorRepository->findOneBy(['url' => $slug]);
        $getAllArticles = $articleRepository->findAll();

        if ($author) {
            return $this->render('authors/author.html.twig', [
                'slug'           => $slug,
                'author'         => $author,
                'getAllArticles' => $getAllArticles
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }

        
    }

}