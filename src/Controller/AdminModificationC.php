<?php

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
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        /** @var PAdmin $admin */
        $admin = $this->getUser();
        if (!$admin) {
            throw $this->createAccessDeniedException('Vous devez être connecté en admin.');
        }

        // Récupération des données liées à cet admin
        $design = $em->getRepository(Designe::class)->findOneBy(['admin' => $admin]);
        $IP     = $em->getRepository(InformationPersonelle::class)->findOneBy(['admin' => $admin]);
        $IPro   = $em->getRepository(InformationPro::class)->findOneBy(['admin' => $admin]);
        $Comp   = $em->getRepository(Competence::class)->findOneBy(['admin' => $admin]);
        $P      = $em->getRepository(Projet::class)->findOneBy(['admin' => $admin]);

        if (!$design || !$IP || !$IPro || !$Comp || !$P) {
            throw $this->createNotFoundException('Une des données est introuvable.');
        }

        // Création des formulaires
        $designForm = $this->createForm(AdminFormDesigne::class, $design);
        $IPForm     = $this->createForm(AdminFormIP::class, $IP);
        $IProForm   = $this->createForm(AdminFormPro::class, $IPro);
        $CompForm   = $this->createForm(AdminFormComp::class, $Comp);
        $ProjetForm = $this->createForm(AdminFormProjet::class, $P);
        $PAForm     = $this->createForm(AdminFormPA::class, $admin);

        // Gestion des requêtes
        $designForm->handleRequest($request);
        $IPForm->handleRequest($request);
        $IProForm->handleRequest($request);
        $CompForm->handleRequest($request);
        $ProjetForm->handleRequest($request);
        $PAForm->handleRequest($request);

        // Traitement des formulaires
        if ($designForm->isSubmitted() && $designForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Design mis à jour avec succès !');
        }

        if ($IPForm->isSubmitted() && $IPForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Informations personnelles mises à jour avec succès !');
        }

        if ($IProForm->isSubmitted() && $IProForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Informations pro mises à jour avec succès !');
        }

        if ($CompForm->isSubmitted() && $CompForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Compétences mises à jour avec succès !');
        }

        if ($ProjetForm->isSubmitted() && $ProjetForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Projets mis à jour avec succès !');
        }

        if ($PAForm->isSubmitted() && $PAForm->isValid()) {
            $plainPassword = $admin->getMdp();
            $hashedPassword = $passwordHasher->hashPassword($admin, $plainPassword);
            $admin->setMdp($hashedPassword);

            $em->flush();
            $this->addFlash('success', 'Mot de passe mis à jour avec succès !');
        }

        // Détection mobile
        $userAgent = $request->headers->get('User-Agent', '');
        $isMobile  = preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent) === 1;

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
