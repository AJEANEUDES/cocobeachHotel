<?php

namespace App\Controller\Admin;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @return Response
     */
    public function getAdminPage(ReservationRepository $reservationRepository, NotificationRepository $notificationRepository): Response
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN", "ROLE_ROOT");
        $today = date('d/m/Y');
        //dd($today);
        $reservations = $reservationRepository->findAllReservations();
        $notifications = $notificationRepository->findAll();
        //$reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        //foreach ($notifications as $notification) {
        //if ($notifications->getCountSend() == false) {
        foreach ($reservations as $reservation) {
            if ($reservation->getNewDateDepart() == $today) {
                foreach ($notifications as $notif) {
                    if ($notif->getCountSend() == 0) {
                        if ($notif->getMessage() != "La reservation de la chambre " . $reservation->getChambre()->getLibelleChambre() . " est terminée") {
                            $notification = new Notification();
                            $notification->setMessage("La reservation de la chambre " . $reservation->getChambre()->getLibelleChambre() . " est terminée");
                            $notification->setCountSend(true);
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($notification);
                            $entityManager->flush();
                        }
                    }
                }
            } else if ($reservation->getDateDepart() == $today) {
                foreach ($notifications as $notif) {
                    if ($notif->getCountSend() == 0) {
                        if ($notif->getMessage() != "La reservation de la chambre " . $reservation->getChambre()->getLibelleChambre() . " est terminée") {
                            $notification = new Notification();
                            $notification->setMessage("La reservation de la chambre " . $reservation->getChambre()->getLibelleChambre() . " est terminée");
                            $notification->setCountSend(true);
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($notification);
                            $entityManager->flush();
                        }
                    }
                }
            }
        }
        //}
        //}
        return $this->render("dashboard/page_accueil.html.twig");
    }

    /**
     * @Route("/gerant", name="gerant")
     * @return Response
     */
    public function getGerantPage(ReservationRepository $reservationRepository): Response
    {
        //$this->denyAccessUnlessGranted("ROLE_ADMIN", "ROLE_GERANT", "ROLE_ROOT");
        $today = date('d/m/Y');
        $reservations = $reservationRepository->findAllReservations();
        //$reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        foreach ($reservations as $reservation) {
            if (!is_null($reservation->getNewDateDepart()) == $today) {
                $notification = new Notification();
                $notification->setMessage("La reservation de la chambre " . $reservation->getChambre()->getLibelleChambre() . " est terminée");
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($notification);
                $entityManager->flush();
            } else if ($reservation->getDateDepart() == $today) {
                $notification = new Notification();
                $notification->setMessage("La reservation de la chambre " . $reservation->getChambre()->getLibelleChambre() . " est terminée");
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($notification);
                $entityManager->flush();
            }
        }
        return $this->render("dashboard/page_accueil.html.twig");
    }
}
