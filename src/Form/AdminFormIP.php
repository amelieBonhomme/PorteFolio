<?php

namespace App\Form;

use App\Entity\InformationPersonelle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class AdminFormIP extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 9],
            ])
            ->add('mail', TextType::class)
            ->add('telephone', TextType::class)
            ->add('localisationMap', TextareaType::class)
            ->add('linkedin', TextType::class)

            // Images des centres d’intérêt
            ->add('centreInteretImg', FileType::class, [
                'label' => 'Images des centres d’intérêt',
                'mapped' => false,
                'required' => false,
                'multiple' => true,
                'constraints' => [
                    new Count([
                        'max' => 4,
                        'maxMessage' => 'Vous ne pouvez pas télécharger plus de 4 images.'
                    ])
                ],
            ])

            // Textes des centres d’intérêt (séparés par virgules)
            ->add('centreInteretTexte', TextType::class)

            ->add('metier', TextType::class)

            // Photo de profil
            ->add('photo', FileType::class, [
                'label' => 'Photo de profil',
                'mapped' => false,
                'required' => false,
                'multiple' => false,
            ])

            // Ordre des centres d’intérêt (ex : "1;2;3")
            ->add('ordrePerso', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InformationPersonelle::class,
        ]);
    }
}
