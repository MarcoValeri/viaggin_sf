<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\TagRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TagController extends AbstractController {

    #[Route('/tag/{slug}', name: 'app_tag', priority: 1)]
    public function showTag(TagRepository $tagRepository, ArticleRepository $articleRepository, string $slug) {

        // Save tags into a variable
        $getAllTags = $tagRepository->findAll();

        // Save articles into a variable
        $getAllArticles = $articleRepository->findAll();

        return $this->render('tags/tag.html.twig', [
            'slug'              => $slug,
            'getAllTags'        => $getAllTags,
            'getAllArticles'    => $getAllArticles
        ]);

    }

}