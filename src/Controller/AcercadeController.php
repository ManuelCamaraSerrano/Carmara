<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AcercadeController extends AbstractController
{
    /**
     * @Route("/acercade", name="acercade")
     */
    public function index(): Response
      {
          return $this->render('acercade.html.twig', [

            
          ]);
      }
}