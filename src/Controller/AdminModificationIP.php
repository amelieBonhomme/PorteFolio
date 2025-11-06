<?php
/*
namespace App\Controller;

use App\Entity\InformationPersonelle;
use App\Form\AdminFormIP;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminModificationIP extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function editIP(Request $request, EntityManagerInterface $em): Response
    {
        $IP = $em->getRepository(InformationPersonelle::class)->find('info001');
        if (!$IP) {
            throw $this->createNotFoundException('IP introuvable.');
        }

        $form = $this->createForm(AdminFormIP::class, $IP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'IP mis à jour avec succès !');
        }

        return $this->render('home/admin.html.twig', [
            'IPForm' => $form->createView(),
        ]);
    }
}*/
