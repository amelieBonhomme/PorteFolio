<?php

namespace App\Controller;

use App\Entity\Designe;
use App\Form\AdminForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminModificationC extends AbstractController
{
    #[Route('/admin', name: 'Modification')]
    public function editDesigne(Request $request, EntityManagerInterface $em): Response
    {
        $designe = $em->getRepository(Designe::class)->find('designe002');
        if (!$designe) {
        throw $this->createNotFoundException('Design introuvable.');
}

        $form = $this->createForm(AdminForm::class, $designe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Design mis à jour avec succès !');
        }

        return $this->render('home/admin.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
