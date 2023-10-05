<?php

namespace App\Controller\Admin;

use App\Form\LoginType;
use App\DataTransferObject\Credentials;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(LoginType::class, new Credentials($authenticationUtils->getLastUsername()));

        $error = $authenticationUtils->getLastAuthenticationError();

        if ($error) {
            $error = $this->addFlash('error', "Information de connexion incorrecte");
        }
        return $this->render('security/login.html.twig', [
            "form" => $form->createView(),
            "error" => $error
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {
        # throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        //return $this->redirectToRoute('login');
        $this->redirectToRoute('login');
    }
}
