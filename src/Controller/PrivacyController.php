<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrivacyController extends AbstractController {

    #[Route('/privacy/privacy-policy', name: 'app_privacy_policy', priority: 1)]
    public function privacyPolicy() {
        return $this->render('pages/privacy-policy.html.twig');
    }

    #[Route('privacy/cookie-policy', name: 'app_cookie_policy', priority: 1)]
    public function cookiePolicy() {
        return $this->render('pages/cookie-policy.html.twig');
    }

}