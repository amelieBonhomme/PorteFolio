<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Entity\PAdmin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        $error = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $admin = $em->getRepository(PAdmin::class)->findOneBy([
                'login' => $data['login'],
                'mdp' => $data['mdp'], // ⚠️ en clair ici, à sécuriser plus tard
            ]);

            if ($admin) {
                return $this->redirectToRoute('dashboard'); // ou autre page
            } else {
                $error = 'Identifiants incorrects';
            }
        }

        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }
}
