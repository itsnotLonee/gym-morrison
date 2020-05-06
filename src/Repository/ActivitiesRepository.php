<?php

namespace App\Repository;

use App\Entity\Activities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activities[]    findAll()
 * @method Activities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activities::class);
    }

    /**
     * @return Activity[]
     */
    public function findAllActivities(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\Activities a
            WHERE a.start_date <= CURRENT_DATE()
            ORDER BY a.start_date ASC'
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
     * @return Activity[]
     */
    public function findTodayMyActivities($user): array
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.user = :usuario', 'a.start_date = CURRENT_DATE()')
            ->setParameter('usuario', $user)
            ->orderBy('a.id', 'ASC');

        $q = $query->getQuery();

        // returns an array of Product objects
        //return $query->getResult();
        return $q->execute();

    }

    /**
     * @return Activity[]
     */
    public function findTodayActivities(): array
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.start_date = CURRENT_DATE()')
            ->orderBy('a.id', 'ASC');

        $q = $query->getQuery();

        // returns an array of Product objects
        //return $query->getResult();
        return $q->execute();

    }

    public function BuscarTodasActividades(){
        // Esto nos da las actividades que vienen, no las antiguas que se han pasado de fecha
        return $this->getEntityManager()
            ->createQuery('
                SELECT activities.id, activities.title, activities.content, activities.start_time, activities.end_time, activities.start_date, activities.end_date, user.name, user.surname
                From App:Activities activities
                JOIN activities.user user
                WHERE activities.start_date>=CURRENT_DATE()
            ');
    }

    public function BuscarTodayActividades(){
        // Esto nos da las actividades que vienen, no las antiguas que se han pasado de fecha
        return $this->getEntityManager()
            ->createQuery('
                SELECT activities.id, activities.title, activities.content, activities.start_time, activities.end_time, activities.start_date, activities.end_date, user.name, user.surname
                From App:Activities activities
                JOIN activities.user user
                WHERE activities.start_date==CURRENT_DATE()
            ');
    }

    public function removeActivity(Activities $activity) {
        //$this->getRepository( Activities::class)->remove($activity);
        $this->getEntityManager()->remove($activity);
        $this->getEntityManager()->flush();
    }

    // /**
    //  * @return Activities[] Returns an array of Activities objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activities
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
