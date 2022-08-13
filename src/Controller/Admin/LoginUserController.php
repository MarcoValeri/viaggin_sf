<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginUserController extends AbstractController {

    /**
     * @Route("/user-admin-login", name="app_login_user")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/login-user.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}