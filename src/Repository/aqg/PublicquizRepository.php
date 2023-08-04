<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Publicquiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Publicquiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publicquiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publicquiz[]    findAll()
 * @method Publicquiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicquizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publicquiz::class);
    }

    // /**
    //  * @return Publicquiz[] Returns an array of Publicquiz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Publicquiz
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
