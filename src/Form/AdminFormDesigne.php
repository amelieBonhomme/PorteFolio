<?php

namespace App\Form;

use App\Entity\Designe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminFormDesigne extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imagePrincipale', TextType::class, [ 'label' => 'Lien de l’image/vidéo principale', ])
            ->add('couleurFond', TextType::class)
            ->add('couleurTexteGeneral', TextType::class)
            ->add('couleurMotivationFooter', TextType::class)
            ->add('couleurTexteMotivationFooter', TextType::class)
            ->add('couleurNavigation', TextType::class)
            ->add('couleurTexteNavigation', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Designe::class,
        ]);
    }
}
