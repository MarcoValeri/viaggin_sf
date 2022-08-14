<?php

namespace App\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationUserForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {

        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Email *']
            ])
            ->add('role', ChoiceType::class, [
                'label'    => false,
                'choices'   => [
                    'ROLE_ADMIN'    => 'ROLE_ADMIN',
                    'ROLE_USER'     => 'ROLE_USER'
                ],
                'multiple'      => true,
            ])
            ->add('password', RepeatedType::class, [
                'type'              => PasswordType::class,
                'label'             => false,
                'options'           => ['attr' => ['class' => 'registration-user__input-email']],
                'required'          => true,
                'first_options' => ['label' => false, 'attr' => ['class' => 'registration-user__input-email user-data__grid-password', 'placeholder'   => 'Password *']],
                'second_options' => ['label' => false, 'attr' => ['class' => 'registration-user__input-email user-data__grid-repeat-password', 'placeholder'   => 'Repeat Password *']],
            ])
            ->add('register', SubmitType::class,
                [
                    'label'     => 'Register',
                    'attr'  => ['class' => 'contact__button button button--white']
                ])
            ->getForm();

    }

}