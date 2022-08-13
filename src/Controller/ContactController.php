<?php

namespace App\Controller;

use App\Form\ContactForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController {

    /**
     * @Route("/contatti", name="app_contact")
     */
    public function contact(Request $request) {

        /**
         * Save the form into the $formContact
         * variable and validate it
         */
        $contactForm = $this->createForm(ContactForm::class);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {

            $name = $contactForm->get('name')->getData();
            $surname = $contactForm->get('surname')->getData();
            $email = $contactForm->get('email')->getData();
            $message = $contactForm->get('message')->getData();

            $emailMessage = "Contatti da ViaggIn.com \n";
            $emailMessage .= "\n";
            $emailMessage .= "Name: " . $name . "\n";
            $emailMessage .= "Surname: " . $surname . "\n";
            $emailMessage .= "Email: " . $email . "\n";
            $emailMessage .= "\n";
            $emailMessage .= "Message: " . "\n";
            $emailMessage .= $message;

            $emailMessage = wordwrap($emailMessage, 100);

            // mail("info@marcovaleri.net", "Contatti ViaggIn.com", $emailMessage);

            return $this->redirectToRoute('app_contact_confirm');

        }

        return $this->render('pages/contact.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }

    /**
     * @Route("/contatti-conferma", name="app_contact_confirm")
     */
    public function contactConfirm() {
        return $this->render("pages/contact-confirm.html.twig");
    }

}