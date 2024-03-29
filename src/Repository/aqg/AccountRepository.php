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
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAssociative()['number'];
    }

    public function getAccountList(string $sort, string $order, string $query = null)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT Account.SteamID, UserName, Bio, QuizPlayed, Win, Lose, QuizCreated, 
        MultiplayerQuizPlayed, YourQuizPlayed, CreationDate, ConnectionDate, 
        IFNULL((SELECT if(panelBan.action = 1, 1, 0) FROM qxqp2383_panel.sanction panelBan WHERE panelBan.steamId = Account.SteamID ORDER BY panelBan.date DESC LIMIT 1), 0) AS 'ban' 
        FROM Account";

        if ($query) {
            $sql .= ' WHERE UserName LIKE :query OR SteamID LIKE :query OR Bio LIKE :query';
        }

        $sql .= " ORDER BY " . $sort . " " . $order;

        $stmt = $conn->prepare($sql);

        if ($query) {
            $stmt->bindValue('query', "%$query%");
        }

        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }



    public function getAccountDetails($steamid)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT Account.SteamID, UserName, Bio, QuizPlayed, Win, Lose, QuizCreated, MultiplayerQuizPlayed, YourQuizPlayed, CreationDate, ConnectionDate, IFNULL((SELECT if(panelBan.action = 1, 1, 0) FROM qxqp2383_panel.sanction panelBan WHERE panelBan.steamId = Account.SteamID ORDER BY panelBan.date DESC LIMIT 1), 0) AS \'ban\' FROM Account WHERE Account.SteamID = :SteamID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('SteamID', $steamid);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAssociative();
    }

    public function getSanctions($steamid)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM qxqp2383_panel.sanction WHERE steamId = :SteamID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('SteamID', $steamid);
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
