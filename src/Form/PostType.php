<?php

namespace App\Form;


use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('title', TextType::class, [
                'attr' => ['placeholder' => 'rentrer le titre dans ce champ',
                'class' => 'input-group-text'
            ],
                'required' => true,
                'label' => ' '
                ])

            ->add('content', CKEditorType::class, [
                'config_name' => 'base_config',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => ' '
                ])

            ->add('image', FileType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => ' ',
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
