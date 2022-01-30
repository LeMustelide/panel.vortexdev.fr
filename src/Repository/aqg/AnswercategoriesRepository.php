<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Answercategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Answercategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answercategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answercategories[]    findAll()
 * @method Answercategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswercategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answercategories::class);
    }

    // /**
    //  * @return Answercategories[] Returns an array of Answercategories objects
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
    public function findOneBySomeField($value): ?Answercategories
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
