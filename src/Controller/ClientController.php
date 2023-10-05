<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    /**
     * @Route("/create-client", name="clients.create", methods="GET|POST")
     */
    public function createClient(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $client = new Client();
            $client->setNomClient($request->get('nom_client'))
                ->setPrenomClient($request->get('prenom_client'))
                ->setTelephoneClient($request->get('telephone_client'))
                ->setEmailClient($request->get('email_client'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $this->addFlash('success', "Le client a été crée avec succes");
        }

        return $this->redirectToRoute('reservations.create');
    }

    /**
     * @Route("/client", name="clients.get")
     */
    public function getReservation(
        ClientRepository $clientRepository
    ): Response {
        return $this->render('dashboard/client/liste_client.html.twig', [
            'clients' => $clientRepository->findAllClients()
        ]);
    }

    /**
     * @Route("/delete-client/{id}", name="clients.delete")
     */
    public function deleteClient(int $id, Request $request): Response
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        $client->setDeleteClient(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Ce client a été supprime avec succes");
        return $this->redirect($request->headers->get('referer'));
    }
}
