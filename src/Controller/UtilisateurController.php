<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/create-utilisateur", name="utilisateurs.create", methods="GET|POST")
     */
    public function createUtilisateur(Request $request, UserPasswordEncoderInterface $userPasswordEncoder,): Response
    {
        if ($request->isMethod('POST')) {
            $utilisateur = new Utilisateur();

            $hash = $userPasswordEncoder->encodePassword($utilisateur, $request->get('password'));
            $utilisateur->setNomUtilisateur($request->get('nom_utilisateur'))
                ->setPrenomUtilisateur($request->get('prenom_utilisateur'))
                ->setEmailUtilisateur($request->get('email_utilisateur'))
                ->setAdresseUtilisateur($request->get('adresse_utilisateur'))
                ->setTelephoneUtilisateur($request->get('telephone_utilisateur'))
                ->setSexeUtilisateur($request->get('sexe_utilisateur'))
                ->setPasswords($hash)
                ->setLevelUtilisateur($request->get('level_utilisateur'))
                ->setUtilisateur($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            $this->addFlash('success', "Le compte de l'utilisateur a été crée avec succes");
        }
        return $this->render('dashboard/utilisateur/creer_utilisateur.html.twig', []);
    }


    /**
     * @Route("/utilisateur", name="utilisateurs.get")
     */
    public function getUtilisateurs(UtilisateurRepository $utilisateurRepository): Response
    {
        return $this->render('dashboard/utilisateur/liste_utilisateur.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAllUsers()
        ]);
    }


    /**
     * @Route("/update-utilisateur/{id}", name="utilisateurs.update", methods="GET|POST")
     */
    public function updateUtilisateur(Request $request, int $id): Response
    {
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        if (!is_null($request->get('nom_utilisateur'))) {
            $utilisateur->setNomUtilisateur($request->get('nom_utilisateur'));
        }
        if (!is_null($request->get('prenom_utilisateur'))) {
            $utilisateur->setPrenomUtilisateur($request->get('prenom_utilisateur'));
        }
        if (!is_null($request->get('email_utilisateur'))) {
            $utilisateur->setEmailUtilisateur($request->get('email_utilisateur'));
        }
        if (!is_null($request->get('adresse_utilisateur'))) {
            $utilisateur->setAdresseUtilisateur($request->get('adresse_utilisateur'));
        }
        if (!is_null($request->get('telephone_utilisateur'))) {
            $utilisateur->setTelephoneUtilisateur($request->get('telephone_utilisateur'));
        }
        if (!is_null($request->get('sexe_utilisateur'))) {
            $utilisateur->setSexeUtilisateur($request->get('sexe_utilisateur'));
        }
        if (!is_null($request->get('level_utilisateur'))) {
            $utilisateur->setLevelUtilisateur($request->get('level_utilisateur'));
        }
        if (!is_null($request->get('status_utilisateur'))) {
            $utilisateur->setStatusUtilisateur($request->get('status_utilisateur'));
        }
        $utilisateur->setDateModifier(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Cet compte utilisateur a été modifie avec succes");

        return $this->redirectToRoute('utilisateurs.get');
    }

    /**
     * Methode permettant d'afficher la vue
     * @Route("/mon-compte", name="mon_compte")
     */
    public function monCompte()
    {
        return $this->render('dashboard/utilisateur/mon_compte.html.twig', []);
    }

    /**
     * Methode permettant la mise a jour d'un compte
     * @Route("/utilisateur-mon-compte", name="utilisateurs.compte.update", methods="GET|POST")
     */
    public function updateProfile(Request $request)
    {
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->find($this->getUser());
        $utilisateur->setNomUtilisateur($request->get('nom_utilisateur'))
            ->setPrenomUtilisateur($request->get('prenom_utilisateur'))
            ->setEmailUtilisateur($request->get('email_utilisateur'))
            ->setAdresseUtilisateur($request->get('adresse_utilisateur'))
            ->setTelephoneUtilisateur($request->get('telephone_utilisateur'));
        //->setPseudoUtilisateur($request->get('pseudo_utilisateur'));
        //dd($utilisateur);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', "Votre compte utilisateur a été modifie avec succes");

        return $this->redirectToRoute('mon_compte');
    }

    /**
     * @Route("/update-utilisateur-password", name="utilisateurs.update.password", methods="GET|POST")
     */
    public function updateUtilisateurMotDePasse(
        Request $request,
        UserPasswordEncoderInterface $userPasswordEncoder
    ): Response {
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->find($this->getUser());
        $password1 = $request->get('password1');
        $password2 = $request->get('password2');
        $password3 = $request->get('password3');

        $checkPassword = $userPasswordEncoder->isPasswordValid($utilisateur, $password1);
        $hashMpd = $userPasswordEncoder->encodePassword($utilisateur, $password2);
        //$argon2id$v=19$m=65536,t=4,p=1$Y2wveHFNalJ1MmF1UzM4ZQ$V3ga1UQF90rbxLIdqZfSQgtjTDZvgHjCa45B/tzE7mY
        if ($checkPassword && $password2 == $password3) {
            $utilisateur->setPasswords($hashMpd);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', "Votre mot de passe a été modifie avec succes");
        } else {
            $this->addFlash('error', "Vos mot de passe ne sont passe identiques");
        }

        /* $entityManager = $this->getDoctrine()->getManager();
        $info = $utilisateur->getPseudoUtilisateur();

        if ($utilisateur->getStatusUtilisateur() == true) {
            $utilisateur->setStatusUtilisateur(true);

            $sysLog = new SystemeLog(
                "Modification",
                "Modification d'un compte utilisateur --> ($info)",
                $this->getUser()
            );
            $entityManager->persist($sysLog);

            $entityManager->flush();
            $this->addFlash('success', 'Votre compte utilisateur a été modifie avec succes');
        } else if ($utilisateur->getStatusUtilisateur() == false) {
            $utilisateur->setStatusUtilisateur(false);

            $sysLog = new SystemeLog(
                "Modification",
                "Modification d'un compte utilisateur --> ($info)",
                $this->getUser()
            );
            $entityManager->persist($sysLog);

            $entityManager->flush();
            $this->addFlash('success', 'Votre compte utilisateur a été modifie avec succes');
        } */

        return $this->redirectToRoute('mon_compte');
    }

    /**
     * @Route("/delete-utilisateur/{id}", name="utilisateurs.delete")
     */
    public function deleteUtilisateur(int $id): Response
    {
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        $utilisateur->setDeleteUtilisateur(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Cet utilisateur a été supprime avec succes");
        return $this->redirectToRoute('utilisateurs.get');
    }
}
