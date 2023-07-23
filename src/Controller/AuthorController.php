<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;

class AuthorController extends AbstractController {

    #[Route('/autori/tutti-gli-autori', name: 'app_authors', priority: 1)]
    public function authors(AuthorRepository $authorRepository, ArticleRepository $articleRepository) {

        // Save authors into a variable
        $getAllAuthors = $authorRepository->findAll();

        return $this->render('authors/authors.html.twig', [
            'getAllAuthors'  => $getAllAuthors
        ]);
    }

    #[Route('/autori/{slug}/pagina-{pageNumber}', name: 'app_author', priority: 1)]
    public function author(AuthorRepository $authorRepository, ManagerRegistry $doctrine, string $slug, string $pageNumber)
    {
        $fromArticleNumber = $pageNumber * 10;
        $sqlQuery = "
            SELECT
                author.url AS authorUrl,
                article.url AS articleUrl,
                article.title,
                article.date,
                image.file_name,
                image.alternative_text,
                article.content,
                author.url
            FROM
                article
            INNER JOIN
                image ON article.image_id = image.id
            INNER JOIN
                author ON article.author_id = author.id
            WHERE article.date < NOW()
            AND author.url = '{$slug}'
            ORDER BY date DESC
            LIMIT {$fromArticleNumber}, 10
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $articles = $result->fetchAllAssociative();

        $author = $authorRepository->findOneBy(['url' => $slug]);

        if (count($articles) > 0) {
            return $this->render("authors/author.html.twig", [
                'articles'      => $articles,
                'pageNumber'    => $pageNumber,
                'slug'          => $slug,
                'author'        => $author
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }
        
    }

}