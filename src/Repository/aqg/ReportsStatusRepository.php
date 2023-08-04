<?php

namespace App\Repository\aqg;

use App\Entity\aqg\ReportsStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReportsStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportsStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportsStatus[]    findAll()
 * @method ReportsStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportsStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportsStatus::class);
    }

    // /**
    //  * @return ReportsStatus[] Returns an array of ReportsStatus objects
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
    public function findOneBySomeField($value): ?ReportsStatus
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
