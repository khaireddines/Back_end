<?php

namespace App\Repository;

use App\Entity\CarRent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CarRent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarRent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarRent[]    findAll()
 * @method CarRent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarRent::class);
    }

    // /**
    //  * @return CarRent[] Returns an array of CarRent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarRent
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
