<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Reports;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reports|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reports|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reports[]    findAll()
 * @method Reports[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reports::class);
    }

    public function getReportsIsWaiting()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(*) AS number FROM Reports WHERE Status = \'En attente\' ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAssociative();
    }

    public function getReportCount()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(*) AS number FROM Reports';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAssociative();
    }

    public function getReportList($status = 'all'){
        $conn = $this->getEntityManager()->getConnection();
        if($status != 'all'){
            $stmt = $conn->prepare('SELECT ID, Title, Description, Date, Status, SteamID, QuizID, Type FROM Reports WHERE Status = :status');
            $stmt->bindParam('status', $status);
        }
        else{
            $stmt = $conn->prepare('SELECT ID, Title, Description, Date, Status, SteamID, QuizID, Type FROM Reports');
        }
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    // /**
    //  * @return Reports[] Returns an array of Reports objects
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
    public function findOneBySomeField($value): ?Reports
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
