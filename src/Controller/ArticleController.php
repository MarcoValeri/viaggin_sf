<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentForm;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController {

    #[Route('articoli/viaggin-tutti-gli-articoli', name: 'app_article_list', priority: 1)]
    public function articleList(ArticleRepository $articleRepository) {

        // Save all the articles into a variable
        $getArticles = $articleRepository->findAll();

        return $this->render('articles/articles-list.html.twig', [
            'getArticles'   => $getArticles
        ]);

    }

    #[Route('/{slug}', name: 'app_article', priority: 0)]
    public function article(ArticleRepository $articleRepository, Request $request, ManagerRegistry $doctrine, string $slug) {

        /**
         * Save form CommentForm into the
         * $formComment vairiable
         * and
         * validate it
         */
        $formComment = $this->createForm(CommentForm::class);
        $formComment->handleRequest($request);

        if ($formComment->isSubmitted() && $formComment->isValid()) {

            // Get form inputs
            $commentDateInput = $formComment->get('commentData')->getData();
            $commentNameInput = $formComment->get('name')->getData();
            $commentEmailInput = $formComment->get('email')->getData();
            $commentCommentInput = $formComment->get('comment')->getData();

            // Create new Comment
            $newComment = new Comment();
            $newComment->setDate($commentDateInput);
            $newComment->setName($commentNameInput);
            $newComment->setEmail($commentEmailInput);
            $newComment->setContent($commentCommentInput);

            // Create Article and Comment relationship
            $em = $doctrine->getManager();
            $getCurrentArticle = $em->getRepository(Article::class)->findOneBy(['url' => $slug]);

            $getCurrentArticle->addComment($newComment);
            $em->persist($newComment);
            $em->flush();

            // Create successful message with addFlash that save it to sessione and it is able once
            $this->addFlash('success', 'Commento inviato correttamente ed in fase di approvazione');

            // Redirect for cleaning form data
            return $this->redirectToRoute('app_article', ['slug' => $slug]);

        }

        // Save all the articles into a variable
        // $getArticles = $articleRepository->findAll();

        // return $this->render('articles/article.html.twig', [
        //     'getArticles'   => $getArticles,
        //     'slug'          => $slug,
        //     'formComment'   => $formComment->createView()
        // ]);

        $article = $articleRepository->findOneBy(['url' => $slug]);
        
        if ($article) {
            return $this->render('articles/article.html.twig', [
                'article'       => $article,
                'slug'          => $slug,
                'formComment'   => $formComment->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }

    }

}