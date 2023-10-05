<?php

namespace App\Controller;

use App\Entity\Temoignage;
use App\Repository\ClientRepository;
use App\Repository\TemoignageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TemoignageController extends AbstractController
{

    /**
     * @Route("/create-temoignage", name="temoignages.create", methods="GET|POST")
     */
    public function createTemoignage(Request $request, ClientRepository $clientRepository, TemoignageRepository $temoignageRepository): Response
    {
        if ($request->isMethod('POST')) {
            $temoignage = new Temoignage();

            $temoignage->setClient($request->get('client'))
                ->setMessage($request->get('message'))
                ->setNote($request->get('note'));
            //->setUtilisateur($this->getUser());
            //dd($temoignage);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($temoignage);
            $entityManager->flush();

            $this->addFlash('success', "Le temoignage a été crée avec succes");
        }
        return $this->render('dashboard/temoignage/temoignage.html.twig', [
            'clients' => $clientRepository->findAllClients(),
            'temoignages' => $temoignageRepository->findAllTemoignages()
        ]);
    }


    /**
     * @Route("/delete-temoignage/{id}", name="temoignages.delete")
     */
    public function deleteTemoignage(int $id): Response
    {
        $temoignage = $this->getDoctrine()->getRepository(Temoignage::class)->find($id);
        $temoignage->setDeleteTemoig(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Ce temoignage a été supprime avec succes");
        return $this->redirectToRoute('temoignages.create');
    }
}
