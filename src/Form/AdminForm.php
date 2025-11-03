<?php

namespace App\Form;

use App\Entity\Designe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imagePrincipale', TextType::class, ['label' => 'Image principale'])
            ->add('couleurFond', TextType::class, ['label' => 'Couleur du fond'])
            ->add('couleurTexteGeneral', TextType::class, ['label' => 'Couleur texte général'])
            ->add('couleurMotivationFooter', TextType::class, ['label' => 'Couleur rectangle motivation/Contact'])
            ->add('couleurTexteMotivationFooter', TextType::class, ['label' => 'Couleur texte motivation/Contact'])
            ->add('couleurNavigation', TextType::class, ['label' => 'Couleur barre de navigation'])
            ->add('couleurTexteNavigation', TextType::class, ['label' => 'Couleur texte barre navigation']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Designe::class,
        ]);
    }
}
