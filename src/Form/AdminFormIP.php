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
            ->add('images', FileType::class, [
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

            // Texte des centres d’intérêt
            ->add('centreInteretTexte', TextType::class)

            ->add('metier', TextType::class)

            // Photo principale (champ conservé)
            ->add('photo', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])

            ->add('ordrePerso', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InformationPersonelle::class,
        ]);
    }
}
