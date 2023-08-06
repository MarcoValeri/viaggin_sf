<?php

namespace App\Controller;

use App\Form\SearchForm;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home', priority: 1)]
    public function home(Request $request, ManagerRegistry $doctrine)
    {
        $searchForm = $this->createForm(SearchForm::class, [
            'action'    => $this->generateUrl('app_search')
        ]);
        $searchForm->handleRequest($request);

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
            ORDER BY article.date DESC
            LIMIT 10
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $articles = $result->fetchAllAssociative();

        return $this->render('pages/home.html.twig', [
            'articles'      => $articles,
            'searchForm'    => $searchForm
        ]);
    }

}