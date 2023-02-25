<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Suite;
use App\Form\ReservationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{suite_id}', name: 'app_reservation')]
    public function index(Request $request, ManagerRegistry $doctrine, int $suite_id): Response
    {
        $reservation = new Reservation();
        $SuiteRepository = $doctrine->getRepository(Suite::class);
        $suite = $SuiteRepository->find($suite_id);
        $reservation->setSuiteId($suite);
        $reservation->setUserId($this->getUser());
        
        $form = $this->createForm(ReservationType::class,$reservation);
        

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $reservationData=$form->getData();
            $entityManager=$doctrine->getManager();
            $entityManager->persist($reservationData);
            $entityManager->flush();
            
        }

        return $this->render('reservation/index.html.twig', [
            'form' => $form
        ]);
    }

}
