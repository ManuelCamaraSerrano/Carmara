<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use App\Entity\Oficina;
use App\Entity\Provincia;
use App\Entity\Marca;
use App\Entity\Coche;
use App\Entity\Fotos;
use App\Entity\Reserva;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UsuarioCrudController::class)->generateUrl());
    }

    public function configureMenuItems(): iterable
    {
        return [
            

            MenuItem::section('Entidades'),
            MenuItem::linkToCrud('Usuario', 'fa fa-user', Usuario::class),
            MenuItem::linkToCrud('Oficina', 'fa fa-building-o ', Oficina::class),
            MenuItem::linkToCrud('Provincia', 'fa fa-globe-europe', Provincia::class),
            MenuItem::linkToCrud('Marca', 'fab fa-medium', Marca::class),
            MenuItem::linkToCrud('Coche', 'fas fa-car', Coche::class),
            MenuItem::linkToCrud('Fotos', 'fa fa-picture-o', Fotos::class),
            MenuItem::linkToCrud('Reserva', 'fas fa-bookmark', Reserva::class),
            MenuItem::linkToRoute('Alta Masiva Usuarios', 'fa fa-user', 'masivausu'),
        ];
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('ACME Corp.')
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            ->renderSidebarMinimized()

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls()
        ;
    }
    
}
