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

    public function getReportList($size = 10, $page = 1, $sort = 'date' ,$status = 'all'){
        $conn = $this->getEntityManager()->getConnection();
        if($page>1){
            $page = ($page-1) * $size;
        }else{
            $page = $page - 1;
        }
        //$sql = 'SELECT ID, Title, Description, Date, Status, SteamID, QuizID, Type FROM Reports LIMIT '.$page.','.$size;
        if($status != 'all'){
            $stmt = $conn->prepare('SELECT ID, Title, Description, Date, Status, SteamID, QuizID, Type FROM Reports WHERE Status = :status ORDER BY :sort LIMIT :page, :size');
            $stmt->bindParam('status', $status);
        }
        else{
            $stmt = $conn->prepare('SELECT ID, Title, Description, Date, Status, SteamID, QuizID, Type FROM Reports ORDER BY :sort LIMIT :page, :size');
        }
        $stmt->bindParam('sort', $sort);
        $stmt->bindParam('page', $page, \PDO::PARAM_INT);
        $stmt->bindParam('size', $size, \PDO::PARAM_INT);
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
