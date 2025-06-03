<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new Regex([
                        'pattern' => '/\b[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}\b/',
                        'message' => 'Email is not well formed'
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 180,
                        'minMessage' => 'Email must be at least {{ limit }} characters long.',
                        'maxMessage' => 'Email cannot be longer than {{ limit }} characters.'
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your email',
                    'autocomplete' => 'email'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/[A-Z]/',
                        'message' => 'Must contain at least one uppercase letter.'
                    ]),
                    new Regex([
                        'pattern' => '/[0-9]/',
                        'message' => 'Must contain at least one number.'
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Password must be at least {{ limit }} characters long.'
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your password',
                    'autocomplete' => 'new-password'
                ]
            ])
            ->add('username', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 100,
                        'minMessage' => 'User name must be at least {{ limit }} characters long.',
                        'maxMessage' => 'User name cannot be longer than {{ limit }} characters.'
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your full name',
                    'autocomplete' => 'new-username',
                    'tabindex' => '-1',
                    'aria-hidden' => true
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
