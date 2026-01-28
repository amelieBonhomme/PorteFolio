<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login', TextType::class, [
                'label' => 'Identifiant',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Votre identifiant'
                ]
            ])
            ->add('mdp', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Votre mot de passe'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Pas de data_class → normal pour un formulaire de login
        $resolver->setDefaults([]);
    }

    public function getBlockPrefix(): string
    {
        return ''; // supprime le "form[...]" dans les noms de champs
    }
}
