<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Chambre;
use App\Entity\Online;
use App\Entity\Reservation;
use App\Repository\MenuRepository;
use App\Repository\ClientRepository;
use App\Repository\ChambreRepository;
use App\Repository\EvenementRepository;
use App\Repository\RestaurantRepository;
use App\Repository\TemoignageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebController extends AbstractController
{
    /**
     * @Route("/", name="index", methods="GET|POST")
     */
    public function accueil(Request $request, TemoignageRepository $temoignageRepository, PaginatorInterface $paginator, ChambreRepository $chambreRepository, ClientRepository $clientRepository, EvenementRepository $evenementRepository): Response
    {
        //$codeReservation = rand();
        if ($request->isMethod('POST')) {

            $date_debut = new \DateTime($request->get('date_arrivee'));
            $date_fin = new \DateTime($request->get('date_depart'));
            $duree = date_diff($date_fin, $date_debut)->days;

            //$objectChambre = $chambreRepository->findOneBy(['id' => $request->get('chambre')]);
            //$objectClient = $clientRepository->findOneBy(['id' => $request->get('client')]);
            $client = new Client();
            $client->setNomClient($request->get('nom_client'))
                ->setPrenomClient($request->get('prenom_client'))
                ->setTelephoneClient($request->get('telephone_client'))
                ->setEmailClient($request->get('email_client'));

            //$objectClient = $clientRepository->findOneBy(['id' => 'desc']);
            $reservation = new Online();
            $reservation->setDateArrivee($date_debut->format("d/m/Y"))
                ->setDateDepart($date_fin->format("d/m/Y"))
                ->setDureeReservation($duree)
                ->setEtatReservation("1")
                ->setNombreChambre($request->get('nbre_chambre'))
                ->setNombreAdulte($request->get('type_chambre'));
            //dump($client);
            //dd($reservation);
            //$objectChambre->setEtatChambre(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->persist($reservation);
            $entityManager->flush();

            //$this->addFlash('success', "La reservation a été crée avec succes");
        }

        $evenements = $evenementRepository->findAllEvenements();
        //$evenements = $paginator->paginate($events, $request->query->getInt('page', 1), 3);

        $datas = $chambreRepository->findAllChambres();
        $chambres = $paginator->paginate($datas, $request->query->getInt('page', 1), 4);

        return $this->render('website/accueil.html.twig', [
            'temoignages' => $temoignageRepository->findAllTemoignages(),
            'evenements' => $evenements,
            'chambres' => $chambres
        ]);
    }

    /**
     * @Route("/detail-chambre/{id}", name="chambres.detail")
     */
    public function detailChambre(int $id): Response
    {
        $chambre = $this->getDoctrine()->getRepository(Chambre::class)->find($id);
        return $this->render('website/detail_chambre.html.twig', [
            'chambre' => $chambre
        ]);
    }

    /**
     * @Route("/hotel-coco-beach/contactez-nous", name="contacteznous", methods="GET|POST")
     */
    public function contactezNous(): Response
    {
        return $this->render('website/contact.html.twig', []);
    }

    /**
     * @Route("/hotel-coco-beach/gallerie", name="gallerie", methods="GET|POST")
     */
    public function gallerie(): Response
    {
        return $this->render('website/gallerie.html.twig', []);
    }
}
