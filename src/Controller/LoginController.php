<?php
namespace App\Controller;

use App\Form\LoginType;
use App\Entity\PAdmin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        $error = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $admin = $em->getRepository(PAdmin::class)->findOneBy([
                'login' => $data['login'],
                'mdp' => $data['mdp'],
            ]);

            if ($admin) {
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
