<?php

namespace App\Form;

use App\Entity\InformationPro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminFormPro extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEntreprise', TextType::class)
            ->add('titrePoste', TextareaType::class, [
                'attr' => ['rows' => 3],
            ])
            ->add('descriptionEntreprise', TextareaType::class, [
                'attr' => ['rows' => 9],
            ])
            ->add('lienSite', TextType::class)
            ->add('images', FileType::class, [
                'label' => 'Images / Logos de l’entreprise',
                'mapped' => false,
                'required' => false,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InformationPro::class,
        ]);
    }
}
