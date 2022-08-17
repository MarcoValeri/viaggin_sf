<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;

use App\Form\Admin\RegistrationUserForm;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ModifyUserController extends AbstractController {

    #[Route('/admin/users', name: 'app_admin_users')]
    public function showUsers(UserRepository $userRepository) {

        $getUsers = $userRepository->findAll();

        return $this->render("admin/users.html.twig", [
            'getUsers' => $getUsers
        ]);

    }

    #[Route('/admin/user/{id}', name: 'app_admin_user')]
    public function showUser(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, UserRepository $userRepository, string $id, ManagerRegistry $doctrine) {

        // Get form inputs
        $getForm = $this->createForm(RegistrationUserForm::class);
        $getForm->handleRequest($request);

        /**
         * Check if the form has been submitted
         * and
         * if it is valid
         */
        if ($getForm->isSubmitted() && $getForm->isValid()) {

            // Get form inputs
            $getFormInputs = $getForm->getData();

            // Save form inputs into the db
            $em = $doctrine->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $user->setEmail($getFormInputs['email']);
            $user->setPassword(
                $userPasswordHasherInterface->hashPassword($user, $getFormInputs['password'])
            );
            $user->setRoles($getFormInputs['role']);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_admin_users');

        }

        $user = $userRepository->find($id);

        return $this->render("admin/user.html.twig", [
            'user' => $user,
            'getForm' => $getForm->createView()
        ]);

    }

}