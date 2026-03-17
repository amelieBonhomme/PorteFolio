<?php

namespace App\Form;

use App\Entity\Competence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdminFormComp extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('images', FileType::class, [
                'label' => 'Images des compétences',
                'mapped' => false,        // on gère l’upload dans le contrôleur
                'required' => false,
                'multiple' => true,       // plusieurs fichiers
            ])
            ->add('grille', FileType::class, [
                'label' => 'Grille compétance',
                'mapped' => false,
                'required' => false,
            ])
            ->add('documents', FileType::class, [
                'label' => 'Fichiers PDF de competence',
                'mapped' => false, // upload géré dans le contrôleur
                'required' => false,
                'multiple' => true,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competence::class,
        ]);
    }
}
