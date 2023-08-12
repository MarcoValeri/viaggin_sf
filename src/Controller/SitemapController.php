<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\TagRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController {

    #[Route('/sitemap.xml', name: "app_sitemap", defaults: ["_format" => "xml"], priority: 1)]
    public function sitemap(AuthorRepository $authorRepository, TagRepository $tagRepository, ManagerRegistry $doctrine)
    {

        // Save all the articles into a variable
        $sqlQuery = "
            SELECT
                article.url,
                article.date,
                article.update_at
            FROM
                article
            WHERE article.date < NOW()
            ORDER BY article.date DESC
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $articles = $result->fetchAllAssociative();

        // Save all the authors into a variables
        $authors = $authorRepository->findAll();

        // Save all the tags into a variables
        $tags = $tagRepository->findAll();

        return $this->render("seo/sitemap.html.twig", [
            'articles'  => $articles,
            'authors'   => $authors,
            'tags'      => $tags
        ]);

    }

    #[Route('/sitemap_images.xml', name: "app_sitemap_image", defaults: ["_format" => "xml"], priority: 1)]
    public function sitemapImage(ManagerRegistry $doctrine)
    {
        // Save all images into a variable
        $sqlQuery = "
            SELECT
                image.file_name,
                image.title,
                image.description
            FROM
                image
            ORDER BY image.id DESC
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $images = $result->fetchAllAssociative();
        // dd($images);

        return $this->render("seo/sitemap-images.html.twig", [
            'images' => $images,
        ]);
    }

}