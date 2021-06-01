<?php

namespace App\Form;

use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('names',TextType::class,[
                'label'=> 'nom'
            ])
            ->add('sort',ChoiceType::class,[
                'label'=>'unité de mesure',
                'choices' =>[
                    'kg'=> 'kg',
                    'g' => 'g',
                    'cl' => 'cl',
                    'ml' => 'ml',
                    'pièces'=>'pièces',
                    'C.a.café' => 'C.a.café',
                    'C.a.soupe'=>'C.a.soupe']
            ])
            ->add('quantity', NumberType::class,[
                'label'=>'quantité'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
