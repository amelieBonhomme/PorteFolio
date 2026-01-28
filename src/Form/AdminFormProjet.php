<?php
//Fait séparément pour que la sécurité soit gérer à partir d'ici, évite les requêtes post car gérer directement depuis l'orm permet aussi de valider les données
// permet aussi de récupérer le formulaire pour l'afficher ailleurs, simplifie la maintenance
namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;


class AdminFormProjet extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreProjet', TextType::class)
            ->add('pdfFile', FileType::class, [
                'label' => 'Fichier PDF du projet',
                'mapped' => false, // upload géré dans le contrôleur
                'required' => false,
                'multiple' => true,
                'constraints' => [
                    new Count([
                        'max' => 2,
                        'maxMessage' => 'Vous ne pouvez pas télécharger plus de 2 pdf.'
                    ])
                ],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
