<?php
namespace App\EventSubscriber;

use App\Entity\Designe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class GlobalDesignSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private EntityManagerInterface $em;

    public function __construct(Environment $twig, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->em = $em;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $design = $this->em->getRepository(Designe::class)->find('designe002');

        if ($design) {
            $this->twig->addGlobal('couleurFond', $design->getCouleurFond());
            $this->twig->addGlobal('couleurTexte', $design->getCouleurTexteGeneral());
            $this->twig->addGlobal('imagePrincipale', $design->getImagePrincipale());
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
