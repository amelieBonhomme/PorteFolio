<?php
// transmet  le formulaire à la vue , indique la ligne à ajouter gère la soumission
    namespace App\Controller;

    use App\Entity\Designe;
    use App\Entity\InformationPersonelle;
    use App\Entity\InformationPro;
    use App\Entity\Competence;
    use App\Entity\Projet;
    use App\Entity\PAdmin;
    use App\Form\AdminFormDesigne;
    use App\Form\AdminFormIP;
    use App\Form\AdminFormPro;
    use App\Form\AdminFormComp;
    use App\Form\AdminFormProjet;
    use App\Form\AdminFormPA;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

    class AdminModificationC extends AbstractController
    {
        #[Route('/admin', name: 'admin')]
        public function editAdmin(
            Request $request,
            EntityManagerInterface $em,
            UserPasswordHasherInterface $passwordHasher,
            \App\Twig\AccesBDDPageTwig $accesBDD
        ): Response {
            /** @var PAdmin $admin */
            $admin = $this->getUser();
            if (!$admin) {
                throw $this->createAccessDeniedException('Vous devez être connecté en admin.');
            }

            $idAdmin = $admin->getIDAdmin();   // ex: "Admin002"
            $numero  = substr($idAdmin, -3);   // ex: "002"

            // ⚡ transmettre le numéro à l’extension
            $accesBDD->setNumero($numero);

            // Charger les entités en fonction du numéro
            $design = $em->getRepository(Designe::class)->find('designe'.$numero);
            $IP     = $em->getRepository(InformationPersonelle::class)->find('info'.$numero);
            $IPro   = $em->getRepository(InformationPro::class)->find('pro'.$numero);
            $Comp   = $em->getRepository(Competence::class)->find('C'.$numero);
            $P      = $em->getRepository(Projet::class)->find('P'.$numero);
            $PA     = $em->getRepository(PAdmin::class)->find('Admin'.$numero);

            if (!$design || !$IP || !$IPro || !$Comp || !$P || !$PA) {
                throw $this->createNotFoundException('Une des BDD est introuvable (AdminModificationC).');
            }

            // =========================
            // Création des formulaires
            // =========================
            $designForm = $this->createForm(AdminFormDesigne::class, $design);
            $IPForm     = $this->createForm(AdminFormIP::class, $IP);
            $IProForm   = $this->createForm(AdminFormPro::class, $IPro);
            $CompForm   = $this->createForm(AdminFormComp::class, $Comp);
            $ProjetForm = $this->createForm(AdminFormProjet::class, $P);
            $PAForm     = $this->createForm(AdminFormPA::class, $PA);

            // =========================
            // Gestion des requêtes
            // =========================
            $designForm->handleRequest($request);
            $IPForm->handleRequest($request);
            $IProForm->handleRequest($request);
            $CompForm->handleRequest($request);
            $ProjetForm->handleRequest($request);
            $PAForm->handleRequest($request);

            // =========================
            // Traitement du formulaire Design
            // =========================
            if ($designForm->isSubmitted() && $designForm->isValid()) {
                $em->flush();
                $this->addFlash('success', 'Design mis à jour avec succès !');
            }

            // =========================
            // Traitement du formulaire Informations personnelles
            // =========================
            if ($IPForm->isSubmitted() && $IPForm->isValid()) {
                $imageFiles = $IPForm->get('centreInteretImg')->getData();
                $photoFile  = $IPForm->get('photo')->getData();
                $filenames  = [];

                // 🔹 Définir le dossier cible AVANT de l’utiliser
                $numero = substr($admin->getIDAdmin(), -3); // récupère "002" par ex.
                /** @var string $targetDir */
                $targetDir = $this->getParameter('images_directory').'/'.$numero;
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // 🔹 Gestion des images multiples
                if ($imageFiles) {
                    $oldFiles = $IP->getCentreInteretImg();
                    if ($oldFiles) {
                        foreach ($oldFiles as $oldFileName) {
                            $oldPath = $targetDir.'/'.$oldFileName;
                            if (file_exists($oldPath)) {
                                unlink($oldPath);
                            }
                        }
                    }

                    foreach ($imageFiles as $imageFile) {
                        $newFilename = uniqid().'.'.$imageFile->guessExtension();
                        $imageFile->move($targetDir, $newFilename);
                        $filenames[] = $newFilename;
                    }

                    $IP->setCentreInteretImg($filenames);
                }

                // 🔹 Gestion de la photo unique
                if ($photoFile) {
                    $oldPhoto = $IP->getPhoto();
                    if ($oldPhoto && is_array($oldPhoto)) {
                        $oldFileName = $oldPhoto[0];
                        $oldPath = $targetDir.'/'.$oldFileName;
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }

                    $newPhotoFilename = uniqid().'.'.$photoFile->guessExtension();
                    $photoFile->move($targetDir, $newPhotoFilename);

                    $IP->setPhoto([$newPhotoFilename]);
                }

                $em->flush();
                $this->addFlash('success', 'Informations personnelles mises à jour avec succès !');
            }
            // =========================
            // Traitement du formulaire Informations professionnelle
            // =========================
            if ($IProForm->isSubmitted() && $IProForm->isValid()) {
                $imageFiles = $IProForm->get('logo')->getData();
                $filenames  = [];

                // 🔹 Définir le dossier cible AVANT de l’utiliser
                $numero = substr($admin->getIDAdmin(), -3); // ex: "002"
                /** @var string $targetDir */
                $targetDir = $this->getParameter('images_directory').'/'.$numero;
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if ($imageFiles) {
                    // Supprimer les anciens fichiers du bon dossier
                    $oldFiles = $IPro->getLogo();
                    if ($oldFiles) {
                        foreach ($oldFiles as $oldFileName) {
                            $oldPath = $targetDir.'/'.$oldFileName;
                            if (file_exists($oldPath)) {
                                unlink($oldPath);
                            }
                        }
                    }

                    // Ajouter les nouveaux fichiers
                    foreach ($imageFiles as $imageFile) {
                        $newFilename = uniqid().'.'.$imageFile->guessExtension();
                        $imageFile->move($targetDir, $newFilename);
                        $filenames[] = $newFilename;
                    }

                    $IPro->setLogo($filenames);
                }

                $em->flush();
                $this->addFlash('success', 'Informations pro mises à jour avec succès !');
            }


            // =========================
            // Traitement du formulaire Compétences
            // =========================
            if ($CompForm->isSubmitted() && $CompForm->isValid()) {
                $imageFiles1 = $CompForm->get('logoLigne1')->getData();
                $imageFiles2 = $CompForm->get('logoLigne2')->getData();
                $filenames1  = [];
                $filenames2  = [];

                // 🔹 Définir le dossier cible AVANT de l’utiliser
                $numero = substr($admin->getIDAdmin(), -3); // récupère "002" par ex.
                /** @var string $targetDir */
                $targetDir = $this->getParameter('images_directory').'/'.$numero;
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if ($imageFiles1) {
                    $oldFiles = $Comp->getLogoLigne1();
                    if ($oldFiles) {
                        foreach ($oldFiles as $oldFileName) {
                            $oldPath = $targetDir.'/'.$oldFileName;
                            if (file_exists($oldPath)) {
                                unlink($oldPath);
                            }
                        }
                    }

                    foreach ($imageFiles1 as $imageFile) {
                        $newFilename = uniqid().'.'.$imageFile->guessExtension();
                        $imageFile->move($targetDir, $newFilename);
                        $filenames1[] = $newFilename;
                    }

                    $Comp->setLogoLigne1($filenames1);
                }

                if ($imageFiles2) {
                    $oldFiles = $Comp->getLogoLigne2();
                    if ($oldFiles) {
                        foreach ($oldFiles as $oldFileName) {
                            $oldPath = $targetDir.'/'.$oldFileName;
                            if (file_exists($oldPath)) {
                                unlink($oldPath);
                            }
                        }
                    }

                    foreach ($imageFiles2 as $imageFile) {
                        $newFilename = uniqid().'.'.$imageFile->guessExtension();
                        $imageFile->move($targetDir, $newFilename);
                        $filenames2[] = $newFilename;
                    }

                    $Comp->setLogoLigne2($filenames2);
                }

                $em->flush();
                $this->addFlash('success', 'Compétences mises à jour avec succès !');
            }


            // =========================
            // Traitement du formulaire Projets
            // =========================
            if ($ProjetForm->isSubmitted() && $ProjetForm->isValid()) {
                $imageFiles = $ProjetForm->get('pdf')->getData();
                $filenames  = [];

                // 🔹 Définir le dossier cible AVANT de l’utiliser
                $numero = substr($admin->getIDAdmin(), -3); // récupère "002" par ex.
                /** @var string $targetDir */
                $targetDir = $this->getParameter('images_directory').'/'.$numero;
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if ($imageFiles) {
                    $oldFiles = $P->getPdf();
                    if ($oldFiles) {
                        foreach ($oldFiles as $oldFileName) {
                            $oldPath = $targetDir.'/'.$oldFileName;
                            if (file_exists($oldPath)) {
                                unlink($oldPath);
                            }
                        }
                    }

                    foreach ($imageFiles as $imageFile) {
                        $newFilename = uniqid().'.'.$imageFile->guessExtension();
                        $imageFile->move($targetDir, $newFilename);
                        $filenames[] = $newFilename;
                    }

                    $P->setPdf($filenames);
                }

                $em->flush();
                $this->addFlash('success', 'Projets mis à jour avec succès !');
            }


            // =========================
            // Traitement du formulaire Admin
            // =========================
            if ($PAForm->isSubmitted() && $PAForm->isValid()) {
                // Récupérer le mot de passe en clair
                $plainPassword = $PA->getMdp();

                // Hasher le mot de passe
                $hashedPassword = $passwordHasher->hashPassword($PA, $plainPassword);
                $PA->setMdp($hashedPassword);

                $em->flush();
                $this->addFlash('success', 'Mot de passe mis à jour avec succès !');
            }

            // =========================
            // Détection simple du mobile via l’User-Agent
            // =========================
            $userAgent = $request->headers->get('User-Agent', '');
            $isMobile  = preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent) === 1;

            // =========================
            // Affichage de la vue
            // =========================
            return $this->render('home/admin.html.twig', [
                'designForm' => $designForm->createView(),
                'IPForm'     => $IPForm->createView(),
                'IProForm'   => $IProForm->createView(),
                'CompForm'   => $CompForm->createView(),
                'ProjetForm' => $ProjetForm->createView(),
                'PAForm'     => $PAForm->createView(),
                'isMobile'   => $isMobile,
            ]);
        }
    }