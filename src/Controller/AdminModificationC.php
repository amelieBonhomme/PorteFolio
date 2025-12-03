<?php
// transmet  le formulaire à la vue , indique la ligne à ajouter gère la soumission
namespace App\Controller;

use App\Entity\Designe;
use App\Entity\InformationPersonelle;
use App\Entity\InformationPro;
use App\Entity\Competence;
use App\Entity\Projet;
use App\Form\AdminFormDesigne;
use App\Form\AdminFormIP;
use App\Form\AdminFormPro;
use App\Form\AdminFormComp;
use App\Form\AdminFormProjet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminModificationC extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function editAdmin(Request $request, EntityManagerInterface $em): Response
    {
        // Récupération des entités
        $design = $em->getRepository(Designe::class)->find('designe002');
        $IP = $em->getRepository(InformationPersonelle::class)->find('info001');
        $IPro = $em->getRepository(InformationPro::class)->find('pro001');
        $Comp = $em->getRepository(Competence::class)->find('C001');
        $P= $em->getRepository(Projet::class)->find('P001');

        if (!$design || !$IP || !$IPro || !$Comp || !$P) {
            throw $this->createNotFoundException('Design ou Information Personnelle introuvable.');
        }

        // Création des formulaires
        $designForm = $this->createForm(AdminFormDesigne::class, $design);
        $IPForm = $this->createForm(AdminFormIP::class, $IP);
        $IProForm = $this->createForm(AdminFormPro::class, $IPro);
        $CompForm = $this->createForm(AdminFormComp::class, $Comp);
        $ProjetForm = $this->createForm(AdminFormProjet::class, $P);

        // Gestion des requêtes
        $designForm->handleRequest($request);
        $IPForm->handleRequest($request);
        $IProForm->handleRequest($request);
        $CompForm->handleRequest($request);
        $ProjetForm->handleRequest($request);

        // Traitement du formulaire de design
        if ($designForm->isSubmitted() && $designForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Design mis à jour avec succès !');
        }

        // Traitement du formulaire d’informations personnelles
        if ($IPForm->isSubmitted() && $IPForm->isValid()) {
            $imageFiles = $IPForm->get('centreInteretImg')->getData(); // tableau d'UploadedFile
            $photoFile = $IPForm->get('photo')->getData(); // un seul UploadedFile
            $filenames = [];

            // 🔹 Gestion des images multiples (centreInteretImg)
            if ($imageFiles) {
                // Supprimer les anciens fichiers
                $oldFiles = $IP->getCentreInteretImg();
                if ($oldFiles) {
                    foreach ($oldFiles as $oldFileName) {
                        $oldPath = $this->getParameter('images_directory').'/'.$oldFileName;
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                }

                // Ajouter les nouveaux fichiers
                foreach ($imageFiles as $imageFile) {
                    $newFilename = uniqid().'.'.$imageFile->guessExtension();
                    $imageFile->move($this->getParameter('images_directory'), $newFilename);
                    $filenames[] = $newFilename;
                }

                $IP->setCentreInteretImg($filenames);
            }

            // 🔹 Gestion de la photo unique
            if ($photoFile) {
                // Supprimer l’ancienne photo
                $oldPhoto = $IP->getPhoto();
                if ($oldPhoto) {
                    $oldPath = $this->getParameter('images_directory').'/'.$oldPhoto;
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Ajouter la nouvelle photo
                $newPhotoFilename = uniqid().'.'.$photoFile->guessExtension();
                $photoFile->move($this->getParameter('images_directory'), $newPhotoFilename);

                // ⚡ Ici tu stockes juste le nom du fichier (string) ou un tableau JSON avec un seul élément
                $IP->setPhoto([$newPhotoFilename]);

            }

            $em->flush();
            $this->addFlash('success', 'Informations personnelles mises à jour avec succès !');
        }


        if ($IProForm->isSubmitted() && $IProForm->isValid()) {
            $imageFiles = $IProForm->get('logo')->getData(); // tableau d'UploadedFile
            $filenames = [];

            if ($imageFiles) {
                // 🔥 Supprimer les anciens fichiers avant d'ajouter les nouveaux
                $oldFiles = $IPro->getLogo(); // tableau JSON stocké en BDD
                if ($oldFiles) {
                    foreach ($oldFiles as $oldFileName) {
                        $oldPath = $this->getParameter('images_directory').'/'.$oldFileName;
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                }

                // Ajouter les nouveaux fichiers
                foreach ($imageFiles as $imageFile) {
                    $newFilename = uniqid().'.'.$imageFile->guessExtension();
                    $imageFile->move($this->getParameter('images_directory'), $newFilename);
                    $filenames[] = $newFilename;
                }

                $IPro->setLogo($filenames);
            }

            $em->flush();
            $this->addFlash('success', 'Informations pro mises à jour avec succès !');
        }
        if ($CompForm->isSubmitted() && $CompForm->isValid()) {
            $imageFiles1 = $CompForm->get('logoLigne1')->getData(); // tableau d'UploadedFile
            $imageFiles2 = $CompForm->get('logoLigne2')->getData(); // tableau d'UploadedFile
            $filenames1 = [];
            $filenames2 = [];

            if ($imageFiles1) {
                // 🔥 Supprimer les anciens fichiers avant d'ajouter les nouveaux
                $oldFiles = $Comp->getlogoLigne1(); // tableau JSON stocké en BDD
                if ($oldFiles) {
                    foreach ($oldFiles as $oldFileName) {
                        $oldPath = $this->getParameter('images_directory').'/'.$oldFileName;
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                }

                // Ajouter les nouveaux fichiers
                foreach ($imageFiles1 as $imageFile) {
                    $newFilename = uniqid().'.'.$imageFile->guessExtension();
                    $imageFile->move($this->getParameter('images_directory'), $newFilename);
                    $filenames1[] = $newFilename;
                }

                $Comp->setLogoLigne1($filenames1);
            }
            if ($imageFiles2) {
                // 🔥 Supprimer les anciens fichiers avant d'ajouter les nouveaux
                $oldFiles = $Comp->getlogoLigne2(); // tableau JSON stocké en BDD
                if ($oldFiles) {
                    foreach ($oldFiles as $oldFileName) {
                        $oldPath = $this->getParameter('images_directory').'/'.$oldFileName;
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                }

                // Ajouter les nouveaux fichiers
                foreach ($imageFiles2 as $imageFile) {
                    $newFilename = uniqid().'.'.$imageFile->guessExtension();
                    $imageFile->move($this->getParameter('images_directory'), $newFilename);
                    $filenames2[] = $newFilename;
                }

                $Comp->setLogoLigne2($filenames2);
            }

            $em->flush();
            $this->addFlash('success', 'Informations pro mises à jour avec succès !');
        }
        if ($ProjetForm->isSubmitted() && $ProjetForm->isValid()) {
            $imageFiles = $ProjetForm->get('pdf')->getData(); // tableau d'UploadedFile
            $filenames = [];

            if ($imageFiles) {
                // 🔥 Supprimer les anciens fichiers avant d'ajouter les nouveaux
                $oldFiles = $P->getpdf(); // tableau JSON stocké en BDD
                if ($oldFiles) {
                    foreach ($oldFiles as $oldFileName) {
                        $oldPath = $this->getParameter('images_directory').'/'.$oldFileName;
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                }

                // Ajouter les nouveaux fichiers
                foreach ($imageFiles as $imageFile) {
                    $newFilename = uniqid().'.'.$imageFile->guessExtension();
                    $imageFile->move($this->getParameter('images_directory'), $newFilename);
                    $filenames[] = $newFilename;
                }

                $P->setpdf($filenames);
            }

            $em->flush();
            $this->addFlash('success', 'Informations pro mises à jour avec succès !');
        }
        // Détection simple du mobile via l'User-Agent
        $userAgent = $request->headers->get('User-Agent', '');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent) === 1;
        

        // Affichage de la vue
        return $this->render('home/admin.html.twig', [
            'designForm' => $designForm->createView(),
            'IPForm' => $IPForm->createView(),
            'IProForm' => $IProForm->createView(),
            'CompForm' => $CompForm->createView(),
            'ProjetForm' => $ProjetForm->createView(),
            'isMobile' => $isMobile,
        ]);

    }
}
