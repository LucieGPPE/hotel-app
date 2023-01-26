<?php

namespace App\Controller;

use App\Entity\Etablissement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class VisiteurController extends AbstractController
{
    #[Route('/visiteur', name: 'app_visiteur')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $etablissementRepository = $doctrine->getRepository(Etablissement::class);
        $allEtablissements = $etablissementRepository->findAll();
        return $this->render('visiteur/index.html.twig', [
            'controller_name' => 'VisiteurController','etablissements'=>$allEtablissements
        ]);
    }
}
