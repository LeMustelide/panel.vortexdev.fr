<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Answertype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Answertype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answertype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answertype[]    findAll()
 * @method Answertype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswertypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answertype::class);
    }

    // /**
    //  * @return Answertype[] Returns an array of Answertype objects
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
    public function findOneBySomeField($value): ?Answertype
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
