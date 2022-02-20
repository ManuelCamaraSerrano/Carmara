<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MapaNavController extends AbstractController
{
    /**
     * @Route("/mapanav", name="mapanav")
     */
    public function index(): Response
      {
          return $this->render('mapanav.html.twig', [

            
          ]);
      }
}