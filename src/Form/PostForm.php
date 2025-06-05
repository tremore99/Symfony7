<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;

class PostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'label' => 'Post image',
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/svg'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image (jpg, jpeg, png, svg)'
                    ])
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Enter title',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Title'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Enter content',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Content'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
