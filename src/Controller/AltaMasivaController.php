<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\AltaMasivaFormType;
use App\Controller\ResetPasswordController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\Mime\Address;




class AltaMasivaController extends AbstractController
{
    /**
     * @Route("/masivausu", name="masivausu")
     */
    public function register(Request $request,EntityManagerInterface $entityManager, MailerInterface $mailer,ResetPasswordHelperInterface $resetPasswordHelper): Response
    {
        //$gmail = new ResetPasswordController($resetPasswordHelper,$entityManager);
        $user = new Usuario();
        $form = $this->createForm(AltaMasivaFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cadenadividida=explode("\n",$form->get('password')->getData());
                for($i=0; $i<count($cadenadividida);$i++){
                    $cadenadividida[$i] = explode(";",$cadenadividida[$i]);
                }

            for($i=0; $i<count($cadenadividida);$i++){
                $user = new Usuario();
                $user->setEmail($cadenadividida[$i][0]);
                $user->setDni($cadenadividida[$i][1]);
                $user->setPassword("123456");
                $user->setNombre($cadenadividida[$i][2]);
                $user->setApellidos($cadenadividida[$i][3]);
                $user->setTelefono($cadenadividida[$i][4]);

                $user->setRoles(['ROLE_USER']);
                $entityManager->persist($user);
                //$gmail->processSendingPasswordResetEmail($cadenadividida[$i][0],$mailer);
            }
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin');
        }

        return $this->render('altamasiva.html.twig', [
            'altamasivaForm' => $form->createView(),
        ]);
    }
    
}