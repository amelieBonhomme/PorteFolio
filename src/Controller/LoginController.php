<?php
namespace App\Controller;

use App\Form\LoginType;
use App\Entity\PAdmin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        $error = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // 1. Récupérer l’utilisateur par login uniquement
            $admin = $em->getRepository(PAdmin::class)->findOneBy([
                'login' => $data['login'],
            ]);

            // 2. Vérifier le mot de passe saisi avec le hash
            if ($admin && $passwordHasher->isPasswordValid($admin, $data['mdp'])) {
                // Connexion réussie → redirection
                return $this->redirectToRoute('admin');
            } else {
                $error = 'Identifiants incorrects';
            }
        }

        return $this->render('login/admin.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }
}
