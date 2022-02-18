<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ServiciosController extends AbstractController
{
    /**
     * @Route("servicios", name="servicios")
     */
    public function index(): Response
      {
          return $this->render('servicios.html.twig', [

            
          ]);
      }
}