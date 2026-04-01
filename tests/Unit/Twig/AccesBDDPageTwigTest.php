<?php

namespace App\Tests\Unit\Twig;

use App\Twig\AccesBDDPageTwig;
use App\Entity\InformationPersonelle;
use App\Entity\Designe;
use App\Entity\InformationPro;
use App\Entity\Competence;
use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class AccesBDDPageTwigTest extends TestCase
{
    public function testGetGlobalsReturnsEmptyArrayWhenNoPerson()
    {
        // Repo InformationPersonelle qui renvoie []
        $repoPerson = $this->createMock(EntityRepository::class);
        $repoPerson->method('findBy')->willReturn([]);

        // EM qui renvoie ce repo pour InformationPersonelle
        $em = $this->createMock(EntityManagerInterface::class);
        $em->method('getRepository')
            ->with(InformationPersonelle::class)
            ->willReturn($repoPerson);

        // Request sans session (pas besoin ici)
        $request = new Request();
        $requestStack = new RequestStack();
        $requestStack->push($request);

        $extension = new AccesBDDPageTwig($em, $requestStack);

        $globals = $extension->getGlobals();

        $this->assertSame([], $globals);
    }

    public function testGetGlobalsReturnsExpectedKeysWhenOnePersonExists()
    {
        // --- 1. Mock d'une personne ---
        $person = $this->createMock(InformationPersonelle::class);
        $person->method('getNom')->willReturn('Doe');
        $person->method('getPrenom')->willReturn('John');
        $person->method('getMetier')->willReturn('Développeur');
        $person->method('getDescription')->willReturn('Description test');
        $person->method('getMail')->willReturn('john@example.com');
        $person->method('getLinkedin')->willReturn('linkedin.com/john');
        $person->method('getTelephone')->willReturn('0600000000');
        $person->method('getLocalisationMap')->willReturn('Paris');
        $person->method('getPhoto')->willReturn(null);
        $person->method('getCentreInteretTexte')->willReturn('Musique');
        $person->method('getImages')->willReturn(new ArrayCollection([]));
        $person->method('getAdmin')->willReturn(null);

        // --- 2. Mock des autres entités ---
        $design = $this->createMock(Designe::class);
        $design->method('getCouleurFond')->willReturn('#ffffff');
        $design->method('getCouleurTexteGeneral')->willReturn('#000000');
        $design->method('getImagePrincipale')->willReturn(null);
        $design->method('getCouleurMotivationFooter')->willReturn('#cccccc');
        $design->method('getCouleurTexteMotivationFooter')->willReturn('#333333');
        $design->method('getCouleurNavigation')->willReturn('#444444');
        $design->method('getCouleurTexteNavigation')->willReturn('#555555');

        $IPro = $this->createMock(InformationPro::class);
        $IPro->method('getNomEntreprise')->willReturn('ACME');
        $IPro->method('getTitrePoste')->willReturn('Dev');
        $IPro->method('getDescriptionEntreprise')->willReturn('Desc');
        $IPro->method('getLienSite')->willReturn('https://example.com');
        $IPro->method('getImages')->willReturn(new ArrayCollection([]));

        $Comp = $this->createMock(Competence::class);
        $Comp->method('getImages')->willReturn(new ArrayCollection([]));
        $Comp->method('getDocuments')->willReturn(new ArrayCollection([]));
        $Comp->method('getGrille')->willReturn('grille-test');

        $P = $this->createMock(Projet::class);
        $P->method('getTitreProjet')->willReturn('Projet A;Projet B');
        $P->method('getDocuments')->willReturn(new ArrayCollection([]));

        // --- 3. Repositories mockés ---
        $repoPerson = $this->createMock(EntityRepository::class);
        $repoPerson->method('findBy')->willReturn([$person]);

        $repoDesign = $this->createMock(EntityRepository::class);
        $repoDesign->method('findOneBy')->willReturn($design);

        $repoIPro = $this->createMock(EntityRepository::class);
        $repoIPro->method('findOneBy')->willReturn($IPro);

        $repoComp = $this->createMock(EntityRepository::class);
        $repoComp->method('findOneBy')->willReturn($Comp);

        $repoP = $this->createMock(EntityRepository::class);
        $repoP->method('findOneBy')->willReturn($P);

        // --- 4. EntityManager qui renvoie le bon repo selon la classe ---
        $em = $this->createMock(EntityManagerInterface::class);
        $em->method('getRepository')->willReturnCallback(function ($class) use (
            $repoPerson,
            $repoDesign,
            $repoIPro,
            $repoComp,
            $repoP
        ) {
            return match ($class) {
                InformationPersonelle::class => $repoPerson,
                Designe::class              => $repoDesign,
                InformationPro::class       => $repoIPro,
                Competence::class           => $repoComp,
                Projet::class               => $repoP,
                default                     => $this->createMock(EntityRepository::class),
            };
        });

        // --- 5. Request + Session (obligatoire car ton code lit la session) ---
        $request = new Request();
        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);

        $requestStack = new RequestStack();
        $requestStack->push($request);

        // --- 6. Extension Twig ---
        $extension = new AccesBDDPageTwig($em, $requestStack);

        // --- 7. Exécution ---
        $globals = $extension->getGlobals();

        // --- 8. Vérifications minimales mais utiles ---
        $this->assertArrayHasKey('personnes', $globals);
        $this->assertArrayHasKey('selectedPerson', $globals);
        $this->assertSame($person, $globals['selectedPerson']);
        $this->assertCount(1, $globals['personnes']);
    }
}
