<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Suite;
use App\Entity\User;
use App\Form\ReservationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    
    #[Route('/mesreservations', name: 'app_reservation')]
    public function mesReservations(Request $request, ManagerRegistry $doctrine): Response
    {
       
        // Récupération des réservations
        $user = $this->getUser();
        $reservations = $user->getReservations();
        return $this->render('reservation/liste.html.twig', [
            'reservations' => $reservations
        ]);
    }
    
    #[Route('/reservation/{suite_id}', name: 'app_reserver')]
    public function reserver(Request $request, ManagerRegistry $doctrine, int $suite_id): Response
    {
        $reservation = new Reservation();

        // Récupération de la suite
        $SuiteRepository = $doctrine->getRepository(Suite::class);
        $suite = $SuiteRepository->find($suite_id);


        $reservation->setSuiteId($suite);
        $reservation->setUserId($this->getUser());
        $reservation->setDateDebut(new \DateTime('now'));
        $reservation->setDateFin(new \DateTime('tomorrow'));
        
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
