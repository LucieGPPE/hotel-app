<?php

namespace App\Controller\Admin;

use App\Entity\Etablissement;
use App\Entity\Image;
use App\Entity\Reservation;
use App\Entity\Suite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hotel App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Etablissements', 'fas fa-hotel', Etablissement::class);
        yield MenuItem::linkToCrud('Suites', 'fas fa-bed', Suite::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-image', Image::class);
        yield MenuItem::linkToCrud('Réservations', 'fas fa-check', Reservation::class);
    }
}
