<?php
//Fait séparément pour que la sécurité soit gérer à partir d'ici, évite les requêtes post car gérer directement depuis l'orm permet aussi de valider les données
// permet aussi de récupérer le formulaire pour l'afficher ailleurs, simplifie la maintenance
namespace App\Form;

use App\Entity\Designe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminFormDesigne extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imagePrincipale', TextType::class)
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
