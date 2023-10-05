<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenementController extends AbstractController
{
    /**
     * @Route("/create-evenement", name="evenements.create", methods="GET|POST")
     */
    public function createEvenement(Request $request, EvenementRepository $evenementRepository): Response
    {
        if ($request->isMethod('POST')) {
            $evenement = new Evenement();

            $imageEvent = $request->files->get('image_event');
            if (!is_null($imageEvent)) {
                $fichier = md5(uniqid()) . '.' . $imageEvent->guessExtension();
                $imageEvent->move($this->getParameter('upload_folder'), $fichier);
            }

            $evenement->setTitreEvent($request->get('titre_event'))
                ->setDateEvent($request->get('date_event'))
                ->setImage($fichier)
                ->setDescriptionEvent($request->get('description_event'));
            //dd($evenement);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            $this->addFlash('success', "L'evenement a été crée avec succes");
        }
        return $this->render('dashboard/evenement/evenement.html.twig', [
            'evenements' => $evenementRepository->findAllEvenements()
        ]);
    }

    /**
     * @Route("/delete-evenement/{id}", name="evenements.delete")
     */
    public function deleteEvenement(int $id): Response
    {
        $evenement = $this->getDoctrine()->getRepository(Evenement::class)->find($id);
        $evenement->setDeleteEvent(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Cet evenement a été supprime avec succes");
        return $this->redirectToRoute('evenements.create');
    }
}
