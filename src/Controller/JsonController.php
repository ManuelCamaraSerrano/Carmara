<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Coche;
use App\Entity\Marca;
use App\Entity\Oficina;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;



use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\Mime\Address;




class JsonController extends AbstractController
{
   
    /**
     * @Route("/coches", name="coches")
     */
    public function coches(ManagerRegistry $doctrine): Response
    {
        $coches = $doctrine->getRepository(Coche::class)->findAll();
        
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $jsonContent = $serializer->serialize($coches, 'json');
        return new Response($jsonContent);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/marcas", name="marcas")
     */
    public function marcas(ManagerRegistry $doctrine): Response
    {
        $marcas = $doctrine->getRepository(Marca::class)->findAll();
        
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $jsonContent = $serializer->serialize($marcas, 'json');
        return new Response($jsonContent);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/oficinas", name="oficinas")
     */
    public function oficinas(ManagerRegistry $doctrine): Response
    {
        $oficinas = $doctrine->getRepository(Oficina::class)->findAll();
        
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $jsonContent = $serializer->serialize($oficinas, 'json');
        return new Response($jsonContent);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

   
    
}