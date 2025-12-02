<?php
//Fait séparément pour que la sécurité soit gérer à partir d'ici, évite les requêtes post car gérer directement depuis l'orm permet aussi de valider les données
// permet aussi de récupérer le formulaire pour l'afficher ailleurs, simplifie la maintenance
namespace App\Form;

use App\Entity\InformationPro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdminFormPro extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEntreprise', TextType::class)
            ->add('titrePoste', TextareaType::class)
            ->add('descriptionEntreprise1', TextareaType::class, ['attr' => [ 'rows' => 9],])
            ->add('lienSite', TextareaType::class)
            ->add('logo', FileType::class, [
                'label' => 'Logo entreprise',
                'mapped' => false,
                'required' => false,
                'multiple' => true,
            ])
            ->add('ordrepro', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InformationPro::class,
        ]);
    }
}
