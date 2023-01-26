<?php

namespace App\Controller;

use App\Entity\Suite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;

class SuiteController extends AbstractController
{    
    #[Route('/suites/{id}', name: 'app_suite')]
    public function suite(ManagerRegistry $doctrine,int $id): Response
    {
        $suiteRepository = $doctrine->getRepository(Suite::class);
        $suite = $suiteRepository->find($id);
        return $this->render('suites/index.html.twig', [
            'controller_name' => 'SuiteController','suite'=>$suite
        ]);
    }

  
}
