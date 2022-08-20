<?php

namespace App\Form;

use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class CommentForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('commentData', HiddenType::class,
                [
                    'data'  => date('d-m-Y')
                ])
            ->add('name', TextType::class,
                [
                    'label' => 'Nome *',
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
                        ]
                    ])
            ->add('email', EmailType::class,
                [
                    'label' => 'Email *',
                    'required' => true,
                    'invalid_message' => 'Errore: indirizzo email non valido'
                ])
            ->add('comment', TextareaType::class,
                [
                    'label' => 'Commento *',
                    'required' => true,
                    'constraints' =>
                        [
                            new Length([
                                'min' => 10,
                                'max' => 1000,
                                'minMessage' => 'Commento è troppo corto, dovrebbe essere di almeno 10 caratteri',
                                'maxMessage' => 'Messaggio è troppo lungo, dovrebbe essere di massimo 1000 caratteri'
                            ])
                        ]
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'Invia'
                ])
            ->getForm();

    }

}