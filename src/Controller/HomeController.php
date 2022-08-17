<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    #[Route('/', name: 'app_home', priority: 1)]
    public function home() {
        return $this->render('home.html.twig');
    }

}