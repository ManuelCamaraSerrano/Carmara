<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Coche;
use App\Entity\Marca;
use App\Entity\Oficina;
use App\Entity\Reserva;
use App\Repository\ReservaRepository;
use App\Repository\CocheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;



use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\Mime\Address;




class JsonController extends AbstractController
{
   
    /**
     * @Route("/coches/{f1}/{f2}", name="coches")
     */
    public function coches(ManagerRegistry $doctrine,string $f1, string $f2): Response
    {
        $reservarepo = new ReservaRepository($doctrine);
        $reservasOcupadas = $reservarepo->cochesPorfechas($f1,$f2);
        $cocherepo = new CocheRepository($doctrine);
        if(count($reservasOcupadas)==0)
        {
            $coches= $cocherepo->findAll();
        }
        else{
            $datos="";
        
            for($i=0; $i<count($reservasOcupadas);$i++){
                if($i==0)
                {
                    $datos = $datos.$reservasOcupadas[$i][1];
                }
                else{
                    $datos = $datos.",".$reservasOcupadas[$i][1];
                }
                
            }
            
            $coches = $cocherepo->cochesNoReservados($datos);
        }
        
        
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


    /**
     * @Route("/insertaReserva/{fechaini}/{fechafin}/{ofireco}/{ofidevo}/{precioTotal}/{coche}/{usuario}", name="insertReserva")
     */
    public function insertaReserva(EntityManagerInterface $entityManager,ManagerRegistry $doctrine,string $fechaini,string $fechafin, string $ofireco, string $ofidevo, int $precioTotal, int $coche,string $usuario): Response
    {

        $fechaini=  str_replace("-", "/", $fechaini);
        $fechafin =  str_replace("-", "/", $fechafin);
        $ofirecogida = $doctrine->getRepository(Oficina::class)->find($ofireco);
        $ofidevolucion = $doctrine->getRepository(Oficina::class)->find($ofidevo);
        $cochee = $doctrine->getRepository(Coche::class)->find($coche);
        $usu = $doctrine->getRepository(Usuario::class)->find($usuario);
        $array = array($fechaini, $fechafin, $ofirecogida, $ofidevolucion,$precioTotal,$cochee,$usu);
        $reservarepo = new ReservaRepository($doctrine);
        $insert = $reservarepo->insertaReserva($array,$entityManager);

        
        return new Response("ok");

    }


    /**
     * @Route("/cochesFiltrados/{f1}/{f2}/{marca}/{precio}", name="cochesfiltrados")
     */
    public function cochesfiltrados(ManagerRegistry $doctrine,string $f1, string $f2, string $marca, string $precio): Response
    {
        $reservarepo = new ReservaRepository($doctrine);
        $reservasOcupadas = $reservarepo->cochesPorfechas($f1,$f2);
        $cocherepo = new CocheRepository($doctrine);
        if(count($reservasOcupadas)==0)
        {
            $coches= $cocherepo->findAll();
        }
        else{
            $datos="";
        
            for($i=0; $i<count($reservasOcupadas);$i++){
                if($i==0)
                {
                    $datos = $datos.$reservasOcupadas[$i][1];
                }
                else{
                    $datos = $datos.",".$reservasOcupadas[$i][1];
                }
                
            }
            $coches = $cocherepo->cochesFiltrados($datos,$marca,$precio);
        }
        
        
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
  
    
}