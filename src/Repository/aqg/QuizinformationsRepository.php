<?php

namespace App\Repository\aqg;

use App\Entity\aqg\Quizinformations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quizinformations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quizinformations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quizinformations[]    findAll()
 * @method Quizinformations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizinformationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quizinformations::class);
    }

    public function getQuizCount()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(*) AS number FROM QuizInformations';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAssociative();
    }

    // /**
    //  * @return Quizinformations[] Returns an array of Quizinformations objects
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
    public function findOneBySomeField($value): ?Quizinformations
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
