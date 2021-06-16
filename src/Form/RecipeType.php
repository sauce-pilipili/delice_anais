<?php

namespace App\Form;

use App\Entity\Recipe;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class)
            ->add('duration',TimeType::class,[
                'attr'=>['type'=>time()]
            ])
            ->add('machine')
            ->add('category',ChoiceType::class,[
                'label'=>'unité de mesure',
                'choices' =>[
                    'entrées'=> 'entrées',
                    'plats' => 'plats',
                    'desserts' => 'desserts',
                    ]
            ])
            ->add('ingredients', CollectionType::class,[
                'label'=>false,
                'entry_type' => IngredientsType::class,
                'entry_options'=> [
                    'label'=>false,
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('directions', CollectionType::class,[
                'label'=>false,
                'entry_type' => DirectionsType::class,
                'entry_options'=> [
                    'label'=>false,
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success'],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
