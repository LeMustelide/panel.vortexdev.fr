<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Playlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Playlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Playlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Playlog[]    findAll()
 * @method Playlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Playlog::class);
    }

    // /**
    //  * @return Playlog[] Returns an array of Playlog objects
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
    public function findOneBySomeField($value): ?Playlog
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
