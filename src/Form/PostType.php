<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('createdAt', DateTimeType::class, [
            'widget' => 'single_text',
            'label' => 'date de création',
            'attr' => [
                'class' => 'form-control shadow'
            ],
            'label_attr' => [
                'class' => 'visually-hidden'
            ]
        ])

            ->add('content', TextareaType::class, [
                'label' => 'contenu de l"article : ',
                'required' => true
                
                ])
            ->add('title', TextType::class, [
                'label' => 'titre de l"article : ',
                'required' => true
                ])

            ->add('image', FileType::class, [
                'label' => 'image de l"article : ',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k', 
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'mettez un fichier valide',
                    ])
                    ],    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
