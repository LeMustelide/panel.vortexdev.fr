<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Account;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Account|null find($id, $lockMode = null, $lockVersion = null)
 * @method Account|null findOneBy(array $criteria, array $orderBy = null)
 * @method Account[]    findAll()
 * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function getUserCount()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(*) AS number FROM Account';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAssociative();
    }

    public function getAllUserName()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT UserName, SteamID FROM Account';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    public function getAllUserNameNotUsedInSteamKey()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT UserName, SteamID FROM qxqp2383_AQG.Account aa WHERE NOT EXISTS(SELECT * FROM qxqp2383_panel.steamKeys psk WHERE psk.steamId = aa.SteamID)';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    public function getPlayCount()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT SUM(QuizPlayed) AS number FROM Account';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAssociative();
    }

    public function getReportCount($steamid)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(*) AS number FROM Reports WHERE SteamID = :SteamID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('SteamID', $steamid);
        $resultSet = $stmt->execute();
        return $resultSet->fetchAssociative()['number'];
    }

    public function getAccountList($size = 10, $page = 1){
        $conn = $this->getEntityManager()->getConnection();
        if($page>1){
            $page = ($page-1) * $size;
        }else{
            $page = $page - 1;
        }
        $sql = 'SELECT SteamID, UserName, Bio, QuizPlayed, Win, Lose, QuizCreated, MultiplayerQuizPlayed, YourQuizPlayed, CreationDate, ConnectionDate, Ban FROM Account LIMIT '.$page.','.$size;
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    // /**
    //  * @return Account[] Returns an array of Account objects
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
    public function findOneBySomeField($value): ?Account
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
