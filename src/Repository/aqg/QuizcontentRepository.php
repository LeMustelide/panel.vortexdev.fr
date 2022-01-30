<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Quizcontent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quizcontent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quizcontent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quizcontent[]    findAll()
 * @method Quizcontent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizcontentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quizcontent::class);
    }

    // /**
    //  * @return Quizcontent[] Returns an array of Quizcontent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Quizcontent
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
