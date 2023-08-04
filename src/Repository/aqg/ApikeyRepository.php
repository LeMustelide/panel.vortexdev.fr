<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Apikey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apikey|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apikey|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apikey[]    findAll()
 * @method Apikey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApikeyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apikey::class);
    }

    public function getKeyCount()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(*) AS number FROM ApiKey';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAssociative();
    }

    public function getKeyList($size = 10, $page = 1){
        $conn = $this->getEntityManager()->getConnection();
        if($page>1){
            $page = ($page-1) * $size;
        }else{
            $page = $page - 1;
        }
        $sql = 'SELECT * FROM ApiKey LIMIT '.$page.','.$size;
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    // /**
    //  * @return Apikey[] Returns an array of Apikey objects
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
    public function findOneBySomeField($value): ?Apikey
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
