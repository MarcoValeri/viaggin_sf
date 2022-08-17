<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Admin\RegistrationUserForm;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserController extends AbstractController {

    #[Route('/admin/registration-user', name: 'app_registration_user')]
    public function registration(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine) {

        // Get Form
        $registrationUserForm = $this->createForm(RegistrationUserForm::class);
        $registrationUserForm->handleRequest($request);

        /**
         * Check if the form has been submitted
         * and
         * if it is valid
         */
        if ($registrationUserForm->isSubmitted() && $registrationUserForm->isValid()) {

            // Get form values
            $getFormInputs = $registrationUserForm->getData();

            $user = new User();
            $user->setEmail($getFormInputs['email']);
            $user->setRoles([$getFormInputs['role']]);
            $user->setPassword(
                $passwordHasher->hashPassword($user, $getFormInputs['password'])
            );

            // Save new user into the db
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            // Regirect to the confirm page
            return $this->redirect($this->generateUrl('app_login_user'));

        }

        return $this->render('admin/registration-user.html.twig', [
            'registrationUserForm' => $registrationUserForm->createView()
        ]);


    }

}