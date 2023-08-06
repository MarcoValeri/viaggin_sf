<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class,
                [
                    'label'     => false,
                    'required'  => true,
                    'attr'      => ['class' => 'input-text', 'placeholder' => 'Cerca su ViaggIn']
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'Cerca',
                    'attr'  => ['class' => 'button button--white']
                ])
            ->getForm();
    }
}