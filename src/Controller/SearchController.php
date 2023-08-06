<?php

namespace App\Controller;

use App\Form\SearchForm;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('cerca/risultati-di-ricerca', name: 'app_search', priority: 1)]
    public function search(ArticleRepository $articleRepository, Request $request, ManagerRegistry $doctrine) {
        
        $articles = '';

        $searchForm = $this->createForm(SearchForm::class, [
            'action'    => $this->generateUrl('app_search')
        ]);
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchInput = $searchForm->get('search')->getData();
            
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
            WHERE article.title LIKE '%{$searchInput}%'
            AND article.date < NOW()
            ORDER BY date DESC
            LIMIT 10
            ";

            $conn = $doctrine->getConnection();
            $stmt = $conn->prepare($sqlQuery);
            $result = $stmt->executeQuery();
            $articles = $result->fetchAllAssociative();

            if (count($articles) > 0) {
                return $this->render('search/search.html.twig', [
                    'searchForm'    => $searchForm->createView(),
                    'articles'      => $articles,
                    'searchTitle'   => 'Risultati di ricerca'
                ]);
            }
        } else {
            $fromArticleNumber = 0;
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

            return $this->render('search/search.html.twig', [
                'searchForm'    => $searchForm->createView(),
                'articles'      => $articles,
                'searchTitle'   => 'Ultimi articoli di ViaggIn'
            ]);
        }
    }
}