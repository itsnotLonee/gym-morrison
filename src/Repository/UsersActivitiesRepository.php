<?php

namespace App\Repository;

use App\Entity\UsersActivities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsersActivities|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersActivities|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersActivities[]    findAll()
 * @method UsersActivities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersActivitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersActivities::class);
    }

    public function BorrarApuntados() {
        return $this->getEntityManager()
            ->createQuery('
                DELETE FROM App:UsersActivities users_activities WHERE users_activities.id=56
                ');
    }

    public function Apuntado($user) {
        return $this->createQueryBuilder('u')
            ->andWhere('u.id = :val')
            ->setParameter('val', 65)
            ->getQuery()
            ->getOneOrNullResult()
            ;
//        return $this->getEntityManager()
//            ->createQuery('
//                SELECT * FROM App:UsersActivities `users_activities` WHERE `activity_id`=7 && `user_id`=21
//                ');
    }

    // /**
    //  * @return UsersActivities[] Returns an array of UsersActivities objects
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
    public function findOneBySomeField($value): ?UsersActivities
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
