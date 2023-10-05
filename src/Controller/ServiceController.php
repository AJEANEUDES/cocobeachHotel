<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ClientRepository;
use App\Repository\ReservationRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    /**
     * @Route("/create-service", name="services.create", methods="GET|POST")
     */
    public function createService(Request $request, ReservationRepository $reservationRepository): Response
    {
        if ($request->isMethod('POST')) {
            $objectReservation = $reservationRepository->findOneBy(['code_reservation' => $request->get('reservation')]);

            $service = new Service();
            $service->setReservation($objectReservation)
                ->setLibelleService($request->get('libelle_service'))
                ->setPrixService($request->get('prix_service'))
                ->setDateService($request->get('date_service'));
            //dd($service);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            $this->addFlash('success', "Le service a été crée avec succes");
        }
        return $this->render('dashboard/services/creer_service.html.twig', [
            'reservations' => $reservationRepository->findAllReservations()
        ]);
    }

    /**
     * @Route("/service", name="services.get")
     */
    public function getServices(ServiceRepository $serviceRepository): Response
    {
        return $this->render('dashboard/services/liste_service.html.twig', [
            'services' => $serviceRepository->findAllServices()
        ]);
    }

    /**
     * @Route("/delete-service/{id}", name="services.delete")
     */
    public function deleteService(int $id): Response
    {
        $service = $this->getDoctrine()->getRepository(Service::class)->find($id);
        $service->setDeleteService(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Ce service a été supprime avec succes");
        return $this->redirectToRoute('services.get');
    }
}
