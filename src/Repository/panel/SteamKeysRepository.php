<?php

namespace App\Repository\panel;

use App\Entity\panel\SteamKeys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method steamKeys|null find($id, $lockMode = null, $lockVersion = null)
 * @method steamKeys|null findOneBy(array $criteria, array $orderBy = null)
 * @method steamKeys[]    findAll()
 * @method steamKeys[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SteamKeysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SteamKeys::class);
    }

    // /**
    //  * @return SteamKeys[] Returns an array of SteamKeys objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SteamKeys
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
