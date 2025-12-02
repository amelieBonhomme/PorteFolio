<?php
//Fait séparément pour que la sécurité soit gérer à partir d'ici, évite les requêtes post car gérer directement depuis l'orm permet aussi de valider les données
// permet aussi de récupérer le formulaire pour l'afficher ailleurs, simplifie la maintenance
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
            ->add('logoLigne1', FileType::class, [
                'label' => 'Logo entreprise',
                'mapped' => false,
                'required' => false,
                'multiple' => true,
            ])
            ->add('logoLigne2', FileType::class, [
                'label' => 'Logo entreprise',
                'mapped' => false,
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
