<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Entity\aqg\Account;
use App\Entity\aqg\Quizinformations;
use App\Entity\aqg\Reports;
use App\Entity\panel\SteamKeys;
use App\Document\Log as aqgLog;

class NavController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function accueil(ManagerRegistry $doctrine)
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $userCount = $customerEntityManager->getRepository(Account::class, 'aqg')->getUserCount();
        $quizCount = $customerEntityManager->getRepository(Quizinformations::class, 'aqg')->getQuizCount();
        $playCount = $customerEntityManager->getRepository(Account::class, 'aqg')->getPlayCount();
        $reportsCount = $customerEntityManager->getRepository(Reports::class, 'aqg')->getReportsIsWaiting();
        return $this->render('Dashboard.html.twig', [
            "user_count" => $userCount['number'],
            "quiz_count" => $quizCount['number'],
            "play_count" => $playCount['number'],
            "reports_count" => $reportsCount['number']
        ]);
    }

    #[Route('/quizList/{size}/{page}', name: 'quizList', defaults: ['size' => 10, 'page' => 1])]
    public function quizList(int $size, int $page, ManagerRegistry $doctrine)
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $quizList = $customerEntityManager->getRepository(Quizinformations::class, 'aqg')->getQuizList($size,$page);
        $quizCount = $customerEntityManager->getRepository(Quizinformations::class, 'aqg')->getQuizCount();

        return $this->render('QuizTable.html.twig', ['quizList' => $quizList, 'page' => $page, 'size' => $size, 'quizCount' => $quizCount['number']]);
    }

    #[Route('/keys/{size}/{page}', name: 'keys', defaults: ['size' => 10, 'page' => 1])]
    public function keys(int $size, int $page, ManagerRegistry $doctrine)
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $username = $customerEntityManager->getRepository(Account::class, 'aqg')->getAllUserNameNotUsedInSteamKey();
        $allUsername = $customerEntityManager->getRepository(Account::class, 'aqg')->getAllUserName();

        if($page>1){
            $start = ($page-1) * $size;
        }else{
            $start = $page - 1;
        }

        $listeKeys = $doctrine->getRepository(SteamKeys::class)
            ->findBy(
                array(),
                null,
                $size,
                $start
            );
        
        $keys = $doctrine->getRepository(SteamKeys::class)
        ->findAll();

        $keysCount = count($keys);

        return $this->render('KeysTable.html.twig', ['page' => $page, 'size' => $size,'listeKeys' => $listeKeys, 'username' => $username, 'allUsername' => $allUsername ,'keysCount' => $keysCount]);
    }

    #[Route('/account/{size}/{page}', name: 'account', defaults: ['size' => 10, 'page' => 1])]
    public function account(int $size, int $page, ManagerRegistry $doctrine)
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $listeAccount = $customerEntityManager->getRepository(Account::class, 'aqg')->getAccountList($size,$page);
        $userCount = $customerEntityManager->getRepository(Account::class, 'aqg')->getUserCount();

        return $this->render('UserTable.html.twig', ['page' => $page, 'size' => $size, 'listeAccount' => $listeAccount, 'userCount' => $userCount['number']]);
    }

    #[Route('/reportList/{size}/{page}', name: 'reportList', defaults: ['size' => 10, 'page' => 1])]
    public function reportList(int $size, int $page, ManagerRegistry $doctrine)
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $reportList = $customerEntityManager->getRepository(Reports::class, 'aqg')->getReportList($size,$page);
        $reportCount = $customerEntityManager->getRepository(Reports::class, 'aqg')->getReportCount();

        return $this->render('ReportTable.html.twig', ['page' => $page, 'size' => $size, 'reportList' => $reportList, 'reportCount' => $reportCount['number']]);
    }

    #[Route('/log/{page}/{sort}', name: 'log', defaults: ['page' => 1, 'sort' => 'date'])]
    public function log(int $page, string $sort = 'date', DocumentManager $dm)
    {
        $size= 50;
        $logCount = count($dm->getRepository(aqgLog::class)->findAll());
        if($sort=='date'){
            $log = $dm->createQueryBuilder(aqgLog::class)
            ->sort('_id', 'desc')
            ->limit($size)
            ->skip($page*$size)
            ->getQuery()
            ->execute();
        }
        elseif($sort == 'ndate'){
            $log = $dm->createQueryBuilder(aqgLog::class)
            ->sort('_id', 'asc')
            ->limit($size)
            ->skip($page*$size)
            ->getQuery()
            ->execute();
        }
        elseif($sort == 'action'){
            $log = $dm->createQueryBuilder(aqgLog::class)
            ->sort('url', 'desc')
            ->limit($size)
            ->skip($page*$size)
            ->getQuery()
            ->execute();
        }
        elseif($sort == 'naction'){
            $log = $dm->createQueryBuilder(aqgLog::class)
            ->sort('url', 'asc')
            ->limit($size)
            ->skip($page*$size)
            ->getQuery()
            ->execute();
        }
        
        return $this->render('Log.html.twig', ['page' => $page, 'size' => $size, 'Logs' => $log, 'logCount' => $logCount, 'sort' => $sort]);
    }
}
