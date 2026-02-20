<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\PersonajePlantilla;
use App\Entity\ArmaPlantilla;
use App\Entity\ArtefactoPlantilla;
use App\Entity\SetArtefactos;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(PersonajePlantillaCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Proyecto DAW GameHub');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        yield MenuItem::linkToCrud('Plantillas de personaje', 'fas fa-list', PersonajePlantilla::class);
        yield MenuItem::linkToCrud('Plantillas de arma', 'fas fa-list', ArmaPlantilla::class);
        yield MenuItem::linkToCrud('Plantillas de artefacto', 'fas fa-list', ArtefactoPlantilla::class);
        yield MenuItem::linkToCrud('Sets de artefactos', 'fas fa-list', SetArtefactos::class);
    }
}
