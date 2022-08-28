<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutUsController extends AbstractController {

    #[Route('/chi-siamo', name: 'app_about-us', priority: 1)]
    public function aboutUs(AuthorRepository $authorRepository) {

        // Save authors into a variable
        $getAllAuthors = $authorRepository->findAll();

        return $this->render('pages/about-us.html.twig', [
            'getAllAuthors'  => $getAllAuthors
        ]);
    }

}