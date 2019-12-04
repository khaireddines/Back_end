<?php

namespace App\Form;

use App\Entity\Accommodation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccommodationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('capacity')
            ->add('beds')
            ->add('baths')
            ->add('availability')
            ->add('prix_night')
            ->add('address')
            ->add('picture')
            ->add('owner')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accommodation::class,
        ]);
    }
}
