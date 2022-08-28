<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController {

    #[Route('/sitemap.xml', name: "app_sitemap", defaults: ["_format" => "xml"], priority: 1)]
    public function sitemap(ArticleRepository $articleRepository, AuthorRepository $authorRepository, TagRepository $tagRepository) {

        // Save all the articles into a variable
        $articles = $articleRepository->findAll();

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

}