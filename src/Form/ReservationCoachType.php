<?php

namespace App\Form;

use App\Entity\ReservationCoach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\DataTransformer\TextToDateTimeTansformer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReservationCoachType extends AbstractType
{

    private $transformer;

    public function __construct(TextToDateTimeTansformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dateDebut', TextType::class, [
            'attr' => [
                'class' => 'form-control shadow'
            ],
            'label_attr' => [
                'class' => 'visually-hidden'
            ]
        ]);
        $builder->get('dateDebut')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationCoach::class,
        ]);
    }
}
