<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Restaurant;
use App\Repository\MenuRepository;
use App\Repository\RestaurantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/create-restaurant", name="restaurants.get", methods="GET|POST")
     */
    public function createRestaurant(Request $request, MenuRepository $menuRepository, RestaurantRepository $restaurantRepository): Response
    {
        if ($request->isMethod('POST')) {
            $objectType = $menuRepository->findOneBy(['id' => $request->get('type_menu')]);
            $restaurant = new Restaurant();
            $restaurant->setNomPlat($request->get('nom_menu'))
                ->setPrixPlat($request->get('prix_menu'))
                ->setMenus($objectType);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($restaurant);
            $entityManager->flush();

            $this->addFlash('success', "Le menu a été crée avec succes");
        }
        return $this->render('dashboard/restaurant/creer_plat.html.twig', [
            'menus' => $menuRepository->findAllMenus(),
            'restaurants' => $restaurantRepository->findAllRestaurant()
        ]);
    }

    /**
     * @Route("/update-restaurant/{id}", name="restaurants.update", methods="GET|POST")
     */
    public function updateRestaurant(Request $request, int $id): Response
    {
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
        if (!is_null($request->get('nom_plat'))) {
            $restaurant->setNomPlat($request->get('nom_plat'));
        }
        if (!is_null($request->get('prix_plat'))) {
            $restaurant->setPrixPlat($request->get('prix_plat'));
        }
        if (!is_null($request->get('status_plat'))) {
            $restaurant->setStatusPlat($request->get('status_plat'));
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', "Ce menu a été modifie avec succes");
        return $this->redirectToRoute('restaurants.get');
    }


    /**
     * @Route("/create-menu", name="menu.create", methods="GET|POST")
     */
    public function createMenu(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $menu = new Menu();
            $menu->setNomMenu($request->get('menu'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menu);
            $entityManager->flush();

            $this->addFlash('success', "Le menu a été crée avec succes");
        }

        return $this->redirect($request->headers->get('referer'));
    }


    /**
     * @Route("/create-plat", name="plats.create", methods="GET|POST")
     */
    public function createPlat(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $menu = new Menu();
            $menu->setNomMenu($request->get('menu'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menu);
            $entityManager->flush();

            $this->addFlash('success', "Le menu a été crée avec succes");
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/hotel-coco-beach/restaurant", name="restaurant", methods="GET|POST")
     */
    public function restaurant(RestaurantRepository $restaurantRepository, MenuRepository $menuRepository): Response
    {
        $restaurants = $restaurantRepository->findAllRestaurants();
        $types = $menuRepository->findAllMenus();
        return $this->render('website/restaurant.html.twig', [
            'restaurants' => $restaurants,
            'types' => $types
        ]);
    }

    /**
     * @Route("/hotel-coco-beach/rechercher/{id}", name="rechercher-restaurant")
     */
    public function searchPlatByCategorie(RestaurantRepository $restaurantRepository, MenuRepository $menuRepository, int $id)
    {
        $restaurants = $restaurantRepository->findSearchPlatCategorie($id);
        $types = $menuRepository->findAllMenus();
        return $this->render('website/restaurant.html.twig', [
            'restaurants' => $restaurants,
            'types' => $types,
            'id' => $id
        ]);
    }
}
