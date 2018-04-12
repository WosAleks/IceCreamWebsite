<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('summary')
            ->add('date')
            ->add('shop')
            ->add('price')
            ->add('stars')
            ->add('public')
            ->add('user')
            ->add('icecream', EntityType::class,[
                'class'=>'App:IceCream',
                'choice_label'=>'name',
            ])
            ->add('user', EntityType::class,[
                'class'=>'App:User',
                'choice_label'=>'username',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
