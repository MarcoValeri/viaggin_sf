<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController {

    /**
     * @Route("/contatti", name="app_contact")
     */
    public function contact() {
        return $this->render('pages/contact.html.twig');
    }

}