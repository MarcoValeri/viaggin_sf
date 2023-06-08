<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\TagRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TagController extends AbstractController {

    #[Route('/tag/{slug}', name: 'app_tag', priority: 1)]
    public function showTag(TagRepository $tagRepository, ArticleRepository $articleRepository, string $slug) {

        $tag = $tagRepository->findOneBy(['url' => $slug]);
        $getAllArticles = $articleRepository->findAll();

        if ($tag) {
            return $this->render('tags/tag.html.twig', [
                'slug'              => $slug,
                'tag'               => $tag,
                'getAllArticles'    => $getAllArticles
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }


    }

}