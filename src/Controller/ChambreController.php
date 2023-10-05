<?php

namespace App\Controller;

use DateTime;
use App\Entity\Chambre;
use App\Entity\Categorie;
use App\Repository\ChambreRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChambreController extends AbstractController
{
    /**
     * @Route("/create-chambre", name="chambres.create", methods="GET|POST")
     */
    public function createChambre(Request $request, CategorieRepository $categorieRepository): Response
    {
        if ($request->isMethod('POST')) {
            $chambre = new Chambre();
            $objectCategorie = $categorieRepository->findOneBy(['id' => $request->get('categorie')]);

            $imageElement = $request->files->get('image_chambre');
            if (!is_null($imageElement)) {
                $fichier = md5(uniqid()) . '.' . $imageElement->guessExtension();
                $imageElement->move($this->getParameter('upload_folder'), $fichier);
            }

            $image1 = $request->files->get('image_chambre1');
            $image2 = $request->files->get('image_chambre2');
            $image3 = $request->files->get('image_chambre3');
            $image4 = $request->files->get('image_chambre4');

            if (!is_null($image1)) {
                $fichier1 = md5(uniqid()) . '.' . $image1->guessExtension();
                $image1->move($this->getParameter('upload_folder'), $fichier1);
                $chambre->setImage1($fichier1);
            }
            if (!is_null($image2)) {
                $fichier2 = md5(uniqid()) . '.' . $image2->guessExtension();
                $image2->move($this->getParameter('upload_folder'), $fichier2);
                $chambre->setImage2($fichier2);
            }
            if (!is_null($image3)) {
                $fichier3 = md5(uniqid()) . '.' . $image3->guessExtension();
                $image3->move($this->getParameter('upload_folder'), $fichier3);
                $chambre->setImage3($fichier3);
            }
            if (!is_null($image4)) {
                $fichier4 = md5(uniqid()) . '.' . $image4->guessExtension();
                $image4->move($this->getParameter('upload_folder'), $fichier4);
                $chambre->setImage4($fichier4);
            }

            $chambre->setChambreCategorie($objectCategorie)
                ->setLibelleChambre($request->get('libelle_chambre'))
                ->setMatriculeChambre($request->get('num_chambre'))
                ->setPrixChambre($request->get('prix_chambre'))
                ->setDescriptionChambre($request->get('description_chambre'))
                ->setUtilisateur($this->getUser())
                ->setImageChambre($fichier);

            //dd($chambre);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chambre);
            $entityManager->flush();

            $this->addFlash('success', "La chambre a été crée avec succes");
        }
        return $this->render('dashboard/chambre/creer_chambre.html.twig', [
            'categories' => $categorieRepository->findAllCategories()
        ]);
    }

    /**
     * @Route("/update-chambre/{id}", name="chambres.update", methods="GET|POST")
     */
    public function updateChambre(Request $request, int $id): Response
    {
        $chambre = $this->getDoctrine()->getRepository(Chambre::class)->find($id);
        $imageElement = $request->files->get('image_chambre');
        $image1 = $request->files->get('image_chambre1');
        $image2 = $request->files->get('image_chambre2');
        $image3 = $request->files->get('image_chambre3');
        $image4 = $request->files->get('image_chambre4');

        if (!is_null($request->get('libelle'))) {
            $chambre->setLibelleChambre($request->get('libelle'));
        }
        if (!is_null($request->get('matricule'))) {
            $chambre->setMatriculeChambre($request->get('matricule'));
        }
        if (!is_null($request->get('prix_chambre'))) {
            $chambre->setPrixChambre($request->get('prix_chambre'));
        }
        if (!is_null($request->get('status_chambre'))) {
            $chambre->setStatusChambre($request->get('status_chambre'));
        }
        if (!is_null($request->get('description'))) {
            $chambre->setDescriptionChambre($request->get('description'));
        }
        if (!is_null($imageElement)) {
            $fichier = md5(uniqid()) . '.' . $imageElement->guessExtension();
            $imageElement->move($this->getParameter('upload_folder'), $fichier);
            $chambre->setImageChambre($fichier);
        }
        if (!is_null($image1)) {
            $fichier1 = md5(uniqid()) . '.' . $image1->guessExtension();
            $image1->move($this->getParameter('upload_folder'), $fichier1);
            $chambre->setImage1($fichier1);
        }
        if (!is_null($image2)) {
            $fichier2 = md5(uniqid()) . '.' . $image2->guessExtension();
            $image2->move($this->getParameter('upload_folder'), $fichier2);
            $chambre->setImage2($fichier2);
        }
        if (!is_null($image3)) {
            $fichier3 = md5(uniqid()) . '.' . $image3->guessExtension();
            $image3->move($this->getParameter('upload_folder'), $fichier3);
            $chambre->setImage3($fichier3);
        }
        if (!is_null($image4)) {
            $fichier4 = md5(uniqid()) . '.' . $image4->guessExtension();
            $image4->move($this->getParameter('upload_folder'), $fichier4);
            $chambre->setImage4($fichier4);
        }

        $chambre->setDateModifier(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', "Cette chambre a été modifie avec succes");

        return $this->redirectToRoute('chambres.get');
    }

    /**
     * @Route("/chambre", name="chambres.get")
     */
    public function getChambres(ChambreRepository $chambreRepository): Response
    {
        return $this->render('dashboard/chambre/liste_chambre.html.twig', [
            'chambres' => $chambreRepository->findAllChambres()
        ]);
    }


    /**
     * @Route("/delete-chambre/{id}", name="chambres.delete")
     */
    public function deleteChambre(int $id): Response
    {
        $chambre = $this->getDoctrine()->getRepository(Chambre::class)->find($id);
        $chambre->setDeleteChambre(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Cette chambre a été supprime avec succes");
        return $this->redirectToRoute('chambres.get');
    }
}
