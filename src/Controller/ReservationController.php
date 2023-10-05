<?php

namespace App\Controller;

use DateTime;
use App\Entity\Online;
use App\Entity\Service;
use App\Entity\Reservation;
use App\Repository\ClientRepository;
use App\Repository\OnlineRepository;
use App\Repository\ChambreRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/create-reservation", name="reservations.create", methods="GET|POST")
     */
    public function createReservation(
        Request $request,
        ChambreRepository $chambreRepository,
        ClientRepository $clientRepository
    ): Response {
        /*StatusReservation = {
            0 --> annule,
            1 --> en attente,
            2 --> confirme,
            3 --> en cours,
            4 --> Terminee
        }*/
        $codeReservation = rand();
        if ($request->isMethod('POST')) {

            $date_debut = new \DateTime($request->get('date_debut'));
            $date_fin = new \DateTime($request->get('date_fin'));
            $duree = date_diff($date_debut, $date_fin)->days;

            $objectChambre = $chambreRepository->findOneBy(['id' => $request->get('chambre')]);
            $objectClient = $clientRepository->findOneBy(['id' => $request->get('client')]);

            $reservation = new Reservation();
            $reservation->setChambre($objectChambre)
                ->setClient($objectClient)
                ->setDateArrivee($date_debut->format("d/m/Y"))
                ->setDateDepart($date_fin->format("d/m/Y"))
                ->setDureeReservation($duree)
                ->setEtatReservation("2")
                ->setUtilisateur($this->getUser())
                ->setCodeReservation($codeReservation)
                ->setNombreChambre($request->get('nbre_chambre'))
                ->setNombreAdulte($request->get('nbre_adulte'))
                ->setNombreEnfant($request->get('nbre_enfant'));
            //dd($reservation);
            $objectChambre->setEtatChambre(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            $this->addFlash('success', "La reservation a été crée avec succes");
        }
        return $this->render('dashboard/reservation/creer_reservation.html.twig', [
            'chambres' => $chambreRepository->findAllChambresLibres(),
            'clients' => $clientRepository->findAllClients()
        ]);
    }

    /**
     * @Route("/update-reservation/{id}", name="reservations.update", methods="GET|POST")
     */
    public function updateReservation(Request $request, ChambreRepository $chambreRepository, ClientRepository $clientRepository, ReservationRepository $reservationRepository, OnlineRepository $onlineRepository, int $id): Response
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $objectChambre = $chambreRepository->findOneBy(['id' => $request->get('chambre')]);

        if ($request->isMethod('POST')) {
            /* if (!is_null($objectChambre)) {
                $reservation->setChambre($objectChambre);
                dd($reservation->getChambre());
                $reservation->getChambre()->setEtatChambre(true);
                $objectChambre->setEtatChambre(false);
            } */
            if (!is_null($request->get('duree'))) {
                $reservation->setDureeReservation($request->get('duree'));
            }
            if (!is_null($request->get('etat'))) {
                $reservation->setEtatReservation("4");
                $reservation->getChambre()->setEtatChambre(false);
            }
        }
        $reservation->setDateModifier(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', "Cette reservation a été modifie avec succes");

        return $this->render('dashboard/reservation/liste_reservation.html.twig', [
            'chambres' => $chambreRepository->findAllChambresLibres(),
            'reservations' => $reservationRepository->findAllReservations(),
            'clients' => $clientRepository->findAllClients(),
            'onlines' => $onlineRepository->findAll()
        ]);
    }

    /**
     * @Route("/update-online/{id}", name="onlines.update", methods="GET|POST")
     */
    public function updateOnline(Request $request, ChambreRepository $chambreRepository, ClientRepository $clientRepository, ReservationRepository $reservationRepository, OnlineRepository $onlineRepository, int $id): Response
    {
        $reservation = $this->getDoctrine()->getRepository(Online::class)->find($id);
        //$objectChambre = $chambreRepository->findOneBy(['id' => $request->get('chambre')]);

        if ($request->isMethod('POST')) {
            /* if (!is_null($objectChambre)) {
                $reservation->setChambre($objectChambre);
                dd($reservation->getChambre());
                $reservation->getChambre()->setEtatChambre(true);
                $objectChambre->setEtatChambre(false);
            } */
            /*  if (!is_null($request->get('duree'))) {
                $reservation->setDureeReservation($request->get('duree'));
            } */
            if (!is_null($request->get('etat'))) {
                $reservation->setEtatReservation("0");
            }
        }
        $reservation->setDateModifier(new \DateTime());
        //$objectChambre->setEtatChambre(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', "Cette reservation a été modifie avec succes");

        return $this->render('dashboard/reservation/liste_reservation_online.html.twig', [
            'chambres' => $chambreRepository->findAllChambresLibres(),
            'reservations' => $reservationRepository->findAllReservations(),
            'clients' => $clientRepository->findAllClients(),
            'onlines' => $onlineRepository->findAll()
        ]);
    }

    /**
     * @Route("/reservation", name="reservations.get")
     */
    public function getReservation(
        ReservationRepository $reservationRepository,
        ChambreRepository $chambreRepository,
        ClientRepository $clientRepository,
        OnlineRepository $onlineRepository
    ): Response {
        return $this->render('dashboard/reservation/liste_reservation.html.twig', [
            'clients' => $clientRepository->findAllClients(),
            'chambres' => $chambreRepository->findAllChambresLibres(),
            'reservations' => $reservationRepository->findAllReservations(),
            'onlines' => $onlineRepository->findAll()
        ]);
    }

    /**
     * @Route("/online", name="onlines.get")
     */
    public function getOnline(
        ReservationRepository $reservationRepository,
        ChambreRepository $chambreRepository,
        ClientRepository $clientRepository,
        OnlineRepository $onlineRepository
    ): Response {
        return $this->render('dashboard/reservation/liste_reservation_online.html.twig', [
            'clients' => $clientRepository->findAllClients(),
            'chambres' => $chambreRepository->findAllChambresLibres(),
            'reservations' => $reservationRepository->findAllReservations(),
            'onlines' => $onlineRepository->findAll()
        ]);
    }


    /**
     * @Route("/facture-reservation/{id}", name="reservations.facture")
     */
    public function getFactureReservation(int $id): Response
    {
        $facture = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $services = $this->getDoctrine()->getRepository(Service::class)->findBy(['reservation' => $id]);
        $total = 0;
        foreach ($services as $service) {
            $total += $service->getPrixService();
        }
        return $this->render('dashboard/reservation/facture_reservation.html.twig', [
            'facture' => $facture,
            'services' => $services,
            'id' => $facture->getId(),
            'totalFinal' => $total
        ]);
    }

    /**
     * @Route("/ajuster-reservation/{id}", name="reservations.ajuster", methods="GET|POST")
     */
    public function ajusterReservation(Request $request, int $id): Response
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);

        $duree_avant = $reservation->getDureeReservation();
        $date_depart_ajuster = new \DateTime($request->get('date_ajuster'));
        $date_debut = new \DateTime();

        if (!is_null($date_depart_ajuster)) {
            $duree = date_diff($date_depart_ajuster, $date_debut)->days;
            $dureeTotal = $duree_avant + $duree;
            $reservation->setNewDateDepart($date_depart_ajuster->format('d/m/Y'))
                ->setNewDateAjuster($date_debut->format('d/m/Y'))
                ->setNewDuree($duree)
                ->setDureeTotal($dureeTotal)
                ->setDateModifier(new \DateTime());
        }
        //dd($reservation);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', "Cette reservation a été ajuster avec succes");

        return $this->redirectToRoute('reservations.get');
    }

    /**
     * @Route("/delete-reservation/{id}", name="reservations.delete")
     */
    public function deleteReservation(int $id): Response
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $reservation->setDeleteReservation(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Cette reservation a été supprime avec succes");
        return $this->redirectToRoute('reservations.get');
    }
}
