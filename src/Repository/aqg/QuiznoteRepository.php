<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Quiznote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quiznote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiznote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiznote[]    findAll()
 * @method Quiznote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuiznoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiznote::class);
    }

    // /**
    //  * @return Quiznote[] Returns an array of Quiznote objects
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
    public function findOneBySomeField($value): ?Quiznote
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
