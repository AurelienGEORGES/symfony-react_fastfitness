<?php

namespace App\Form;

use App\Entity\ReservationDieteticien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationDieteticienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dateDebut', DateTimeType::class, [
            'widget' => 'single_text',
            'attr' => [
                'class' => 'form-control shadow'
            ],
            'label_attr' => [
                'class' => 'visually-hidden'
            ]
        ])    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationDieteticien::class,
        ]);
    }
}
