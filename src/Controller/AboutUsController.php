<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutUsController extends AbstractController {

    #[Route('/chi-siamo', name: 'app_about-us', priority: 1)]
    public function aboutUs() {
        return $this->render('pages/about-us.html.twig');
    }

}