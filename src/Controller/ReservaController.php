<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Reserva;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Json;

class ReservaController extends AbstractController
{
    /**
     * @Route("/reserva", name="reserva")
     */
    public function index(): Response
      {
          return $this->render('reserva.html.twig');
      }

      /**
     * @Route("/filtros", name="filtros")
     */
    public function index1(): Response
    {
        return $this->render('filtros.html.twig');
    }

    /**
     * @Route("/realizareserva", name="reservaCoche")
     */
    public function reservaCoche(Json $datos): Response
    {
        dd($datos);
    }

}