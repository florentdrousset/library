<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class NewBookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('author', TextType::class)
            ->add('publicationDate', DateType::class)
            ->add('genre', ChoiceType::class, [
                'choices'  => [
                    'Roman' => 'Roman',
                    'Poésie' => 'Poésie',
                    'Science-Fiction' => 'Science-Fiction',
                    'Théâtre' => 'Théâtre',
                    'Fable' => 'Fable',
                    'Guerre' => 'Guerre',
                    'Histoire' => 'Histoire',
                    'Cuisine' => 'Cuisine',
                    ]
                ])
            ->add('pitch', TextType::class)
            ->add('quantity', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 15
                ]
            ])

            ->add('add', SubmitType::class)
        ;
    }
}
