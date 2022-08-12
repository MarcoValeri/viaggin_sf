<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Estension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType as TypeCheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class ContactForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class,
                [
                    'label'    => false,
                    'required' => true,
                    'constraints' =>
                        [
                            new Length([
                                'min' => 2,
                                'max' => 20,
                                'minMessage' => 'Nome è troppo corto, dovrebbe essere almeno di 2 caratteri',
                                'maxMessage' => 'Nome è troppo lungo, dovrebbe essere di massimo 20 caratteri'
                            ]),
                            new Regex([
                                'pattern' => '/[a-zA-Z]/',
                                'message' => 'Errore: inserire solo lettere'
                            ])
                        ],
                    'attr' => ['placeholder' => 'Nome *']
                    ])
            ->add('surname', TextType::class,
                [
                    'label' => false,
                    'required' => true,
                    'constraints' =>
                        [
                            new Length([
                                'min' => 2,
                                'max' => 20,
                                'minMessage' => 'Cognome è troppo corto, dovrebbe essere almeno di 2 caratteri',
                                'maxMessage' => 'Cognome è lungo, dovrebbe essere di massimo 20 caratteri'
                            ]),
                            new Regex([
                                'pattern' => '/[a-zA-Z]/',
                                'message' => 'Errore: inserire solo lettere'
                            ])
                            ],
                        'attr' => ['placeholder' => 'Cognome *']
                    ])
            ->add('email', EmailType::class,
                [
                    'label' => false,
                    'required' => true,
                    'invalid_message' => 'Errore: indirizzo email non valido',
                    'attr' => ['placeholder' => 'Email *']
                ])
            ->add('message', TextareaType::class,
                [
                    'label' => false,
                    'required' => true,
                    'constraints' =>
                        [
                            new Length([
                                'min' => 10,
                                'max' => 500,
                                'minMessage' => 'Messaggio è troppo corto, dovrebbe essere di almeno 10 caratteri',
                                'maxMessage' => 'Messaggio è troppo lungo, dovrebbe essere di massimo 500 caratteri'
                            ])
                        ],
                    'attr' => ['placeholder' => 'Messaggio *']

                ])
            ->add('privacy', TypeCheckboxType::class, [
                'label'      => false,
                'required'   => true
            ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'Invia',
                    'attr'  => ['class' => 'contact__button button button--black']
                ])
            ->getForm();
    }

}