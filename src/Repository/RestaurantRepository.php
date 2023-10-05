<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    public function findAllRestaurant()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT restaurant
            FROM App\Entity\Restaurant restaurant
            WHERE restaurant.delete_plat = false
            ORDER BY restaurant.date_creation desc"
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    public function findAllRestaurants()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT restaurant
            FROM App\Entity\Restaurant restaurant
            WHERE restaurant.delete_plat = false
            AND restaurant.status_plat = true
            ORDER BY restaurant.date_creation desc"
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    public function findSearchPlatCategorie($menu = null)
    {
        $query = $this->createQueryBuilder('restaurant')
            ->where('restaurant.status_plat = true')
            ->andwhere('restaurant.delete_plat = false');
        if ($menu != null) {
            $query->leftJoin('restaurant.menus', 'menu')
                ->andWhere('menu.id = :id')
                ->setParameter('id', $menu);
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Restaurant[] Returns an array of Restaurant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Restaurant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
