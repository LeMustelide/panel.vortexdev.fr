<?php

namespace App\Repository\aqg;

use App\Entity\aqg\ReportsType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReportsType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportsType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportsType[]    findAll()
 * @method ReportsType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportsTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportsType::class);
    }

    // /**
    //  * @return ReportsType[] Returns an array of ReportsType objects
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
    public function findOneBySomeField($value): ?ReportsType
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
