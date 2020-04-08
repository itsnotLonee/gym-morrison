<?php

namespace App\Repository;

use App\Entity\UsersPayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsersPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersPayment[]    findAll()
 * @method UsersPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersPayment::class);
    }

    // /**
    //  * @return UsersPayment[] Returns an array of UsersPayment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersPayment
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
