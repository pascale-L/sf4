<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class InscriptionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    //NotBlank = le champs ne soit pas vide
                    new NotBlank(['message' => 'Veuillez indiquer une adresse email']),
                    new Email(['message' => 'Adresse email incorrecte'])
                ]
            ])
            // https://symfony.com/doc/current/reference/forms/types/repeated.html
            // RepeatedType = pour par exemple pouvoir confirmer le mot de passe (le répéter)
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer un mot de passe']),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez indiquer un nom']),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Le nom ne peut contenir plus de {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('pseudo', TextType::class, [
                'constraints' => [ 
                    new NotBlank(['message' => 'Veuillez indiquer un pseudo.']),
                    new Length([
                        'max' => 10,
                        'maxMessage' => 'Le pseudo ne peut contenir plus de {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('telephone', TextType::class,[
                'constraints' => [  
                new NotBlank(['message' => 'Veuillez indiquer un numéro de téléphone.']),
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
