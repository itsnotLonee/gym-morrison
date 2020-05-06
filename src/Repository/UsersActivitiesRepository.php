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

    /**
     * @return UsersActivities[]
     */
    public function ApuntadoActividades($user): array
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.user = :usuario')
            ->setParameter('usuario', $user)
            ->orderBy('a.id', 'ASC');

        $q = $query->getQuery();

        // returns an array of Product objects
        //return $query->getResult();
        return $q->execute();

    }

    /**
     * @return UsersActivities[]
     */
    public function Apuntado($user, $activity): array
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.user = :usuario', 'a.activity = :act')
            ->setParameter('usuario', $user)
            ->setParameter('act', $activity)
            ->orderBy('a.id', 'ASC');

        $q = $query->getQuery();

        // returns an array of Product objects
        //return $query->getResult();
        return $q->execute();

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
