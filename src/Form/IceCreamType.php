<?php

namespace App\Form;

use App\Entity\IceCream;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IceCreamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('brand')
            ->add('flavour')
            ->add('summary')
            ->add('price')
            ->add('description')
            ->add('ingredients')
            ->add('photo')
            ->add('public')
//            ->add('user', EntityType::class, [
//                'class' => 'App:User',
//                'choice_label' => 'username',
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IceCream::class,
        ]);
    }
}
