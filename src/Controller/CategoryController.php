<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/create-category", name="categories.create", methods="GET|POST")
     */
    public function createCategory(Request $request, CategorieRepository $categorieRepository): Response
    {
        if ($request->isMethod('POST')) {
            $category = new Categorie();

            $category->setLibelle($request->get('lebelle'))
                ->setUtilisateur($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', "La categorie de la chambre a été crée avec succes");
        }
        return $this->render('dashboard/category/category.html.twig', [
            'categories' => $categorieRepository->findAllCategories()
        ]);
    }


    /**
     * @Route("/update-category/{id}", name="categories.update", methods="GET|POST")
     */
    public function updateCategory(Request $request, int $id): Response
    {
        $category = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
        if (!is_null($request->get('libelle'))) {
            $category->setLibelle($request->get('libelle'));
        }
        if (!is_null($request->get('status_categorie'))) {
            $category->setStatusCategorie($request->get('status_categorie'));
        }
        $category->setDateModifier(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', "Cette categorie a été modifie avec succes");
        return $this->redirectToRoute('categories.create');
    }


    /**
     * @Route("/delete-category/{id}", name="categories.delete")
     */
    public function deleteCategory(int $id): Response
    {
        $category = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
        $category->setDeleteCategorie(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Cette categorie a été supprime avec succes");
        return $this->redirectToRoute('categories.create');
    }
}
