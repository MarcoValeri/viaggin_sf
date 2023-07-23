<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;

class CategoryController extends AbstractController {

    #[Route('/categories', name: 'app_categories', priority: 1)]
    public function categories() {
        return $this->render('categories/categories.html.twig');
    }

    #[Route('/category/viaggi-pagina-{pageNumber}', name: 'app_category_viaggi')]
    public function categoryViaggi(ArticleRepository $articleRepository, ManagerRegistry $doctrine, string $pageNumber)
    {

        $fromArticleNumber = $pageNumber * 10;
        $sqlQuery = "
            SELECT
                article.category_id,
                article.url,
                article.title,
                article.date,
                image.file_name,
                image.alternative_text,
                article.content
            FROM
                article
            INNER JOIN
                image ON article.image_id = image.id
            WHERE article.date < NOW()
            AND article.category_id = 1
            ORDER BY date DESC
            LIMIT {$fromArticleNumber}, 10
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $articles = $result->fetchAllAssociative();

        if (count($articles) > 0) {
            return $this->render("categories/viaggi.html.twig", [
                'articles'      => $articles,
                'pageNumber'    => $pageNumber
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }
    }

    #[Route('/category/eventi-pagina-{pageNumber}', name: 'app_category_eventi')]
    public function categoryEventi(ArticleRepository $articleRepository, ManagerRegistry $doctrine, string $pageNumber)
    {

        $fromArticleNumber = $pageNumber * 10;
        $sqlQuery = "
            SELECT
                article.category_id,
                article.url,
                article.title,
                article.date,
                image.file_name,
                image.alternative_text,
                article.content
            FROM
                article
            INNER JOIN
                image ON article.image_id = image.id
            WHERE article.date < NOW()
            AND article.category_id = 3
            ORDER BY date DESC
            LIMIT {$fromArticleNumber}, 10
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $articles = $result->fetchAllAssociative();

        if (count($articles) > 0) {
            return $this->render("categories/eventi.html.twig", [
                'articles'      => $articles,
                'pageNumber'    => $pageNumber
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }
    }

    #[Route('/category/documenti-pagina-{pageNumber}', name: 'app_category_documenti')]
    public function categoryDocumenti(ArticleRepository $articleRepository, ManagerRegistry $doctrine, string $pageNumber)
    {

        $fromArticleNumber = $pageNumber * 10;
        $sqlQuery = "
            SELECT
                article.category_id,
                article.url,
                article.title,
                article.date,
                image.file_name,
                image.alternative_text,
                article.content
            FROM
                article
            INNER JOIN
                image ON article.image_id = image.id
            WHERE article.date < NOW()
            AND article.category_id = 2
            ORDER BY date DESC
            LIMIT {$fromArticleNumber}, 10
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $articles = $result->fetchAllAssociative();

        if (count($articles) > 0) {
            return $this->render("categories/documenti.html.twig", [
                'articles'      => $articles,
                'pageNumber'    => $pageNumber
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }
        
    }

    #[Route('/category/vivere-estero-pagina-{pageNumber}', name: 'app_category_estero')]
    public function categoryEstero(ArticleRepository $articleRepository, ManagerRegistry $doctrine, string $pageNumber)
    {

        $fromArticleNumber = $pageNumber * 10;
        $sqlQuery = "
            SELECT
                article.category_id,
                article.url,
                article.title,
                article.date,
                image.file_name,
                image.alternative_text,
                article.content
            FROM
                article
            INNER JOIN
                image ON article.image_id = image.id
            WHERE article.date < NOW()
            AND article.category_id = 4
            ORDER BY date DESC
            LIMIT {$fromArticleNumber}, 10
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $articles = $result->fetchAllAssociative();

        if (count($articles) > 0) {
            return $this->render("categories/vivere-estero.html.twig", [
                'articles'      => $articles,
                'pageNumber'    => $pageNumber
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }

        // Save all the articles into a variable
        // $getArticles = $articleRepository->findAll();

        // return $this->render('categories/vivere-estero.html.twig', [
        //     'getArticles' => $getArticles
        // ]);
    }

}