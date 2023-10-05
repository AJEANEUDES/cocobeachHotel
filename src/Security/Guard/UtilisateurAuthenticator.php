<?php

namespace App\Security\Guard;

use App\Form\LoginType;
use App\DataTransferObject\Credentials;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class UtilisateurAuthenticator extends AbstractFormLoginAuthenticator
{
    private UrlGeneratorInterface $urlGenerator;

    private FormFactoryInterface $formFactory;

    private UserPasswordEncoderInterface $userPasswordEncoder;

    private $security;

    private $session;

    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $userPasswordEncoder,
        Security $security
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->formFactory = $formFactory;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->security = $security;
    }

    //Permet de recuperer le chemin de ma passe de connexion
    public function getLoginUrl()
    {
        return $this->urlGenerator->generate("login");
    }

    //Permet de verifier si la method est egale a <POST> et que notre chemin de connexion est egale a <app_login>
    public function supports(Request $request)
    {
        return $request->isMethod(Request::METHOD_POST) &&
            $request->attributes->get("_route") === "login";
        //dd($request->isMethod(Request::METHOD_POST));
    }

    //Permet de recuperer les valeurs de notre formulaires
    public function getCredentials(Request $request)
    {
        $credentials = new Credentials();
        $forms = $this->formFactory->create(LoginType::class, $credentials)->handleRequest($request);
        if (!$forms->isValid()) {
            return null;
        }
        //dd($credentials);
        return $credentials;
    }

    //Permet de verifier si le token est bien rempli
    //Tester aussi si les valeurs de notre formulaire
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        //Trouve l'utilisateur
        return $userProvider->loadUserByUsername($credentials->getEmailUtilisateur());
    }

    //Verifie si notre password est bon
    public function checkCredentials($credentials, UserInterface $user)
    {
        if ($valid = $this->userPasswordEncoder->isPasswordValid($user, $credentials->getPassword())) {
            return true;
        }

        throw new AuthenticationException("Mot de passe incorrect");
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $user = $this->security->getUser();

        if ($user->checkStatus() == true && $user->getCheckDeleteUtilisateurs() == false) {
            if ($user->getRoles() == ['ROLE_ADMIN']) {
                return new RedirectResponse($this->urlGenerator->generate("admin"));
            } else if ($user->getRoles() == ['ROLE_ROOT']) {
                return new RedirectResponse($this->urlGenerator->generate("admin"));
            } else if ($user->getRoles() == ['ROLE_GERANT']) {
                return new RedirectResponse($this->urlGenerator->generate("gerant"));
            } else if ($user->getRoles() == ['ROLE_CLIENT']) {
                return new RedirectResponse($this->urlGenerator->generate("admin"));
            }
        } else if ($user->checkStatus() == false) {
            $session = new Session();
            if ($session) {
                // add flash messages
                $session->getFlashBag()->add(
                    'error',
                    "Votre compte a ete desactive, veuillez contactez l'administrateur"
                );
                //$this->urlGenerator->generate("logout");
                //return new RedirectResponse();
            }
            return new RedirectResponse($this->urlGenerator->generate("logout"));
        } elseif ($user->getCheckDeleteUtilisateurs() == true) {
            $session = new Session();
            // add flash messages
            $session->getFlashBag()->add(
                'error',
                "Votre compte a ete supprimer, veuillez contactez l'administrateur"
            );
            return new RedirectResponse($this->urlGenerator->generate("login"));
        }
        //Si tout est bon on rediriger sur la page d'accueil
        //return new RedirectResponse($this->urlGenerator->generate("accueils"));
    }
}
