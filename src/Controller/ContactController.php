<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $contact = new Contact();
        $contact->setEmail('email@email.fr');
        $contact->setSujet('Sujet du contact');
        $contact->setTexte('Texte du message');

        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            $contact = $form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();

        }

        return $this->render('contact/index.html.twig', [
            'form' => $form
        ]);
    }
}
