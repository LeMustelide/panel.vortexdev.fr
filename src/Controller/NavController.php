<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\aqg\Account;
use App\Entity\aqg\Quizinformations;
use App\Entity\aqg\Reports;
use App\Entity\panel\SteamKeys;

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
        $quizCount =$customerEntityManager->getRepository(Quizinformations::class, 'aqg')->getQuizCount();

        return $this->render('QuizTable.html.twig', ['quizList' => $quizList, 'page' => $page, 'size' => $size, 'quizCount' => $quizCount['number']]);
    }
    #[Route('/keys', name: 'keys')]
    public function keys(ManagerRegistry $doctrine)
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $username = $customerEntityManager->getRepository(Account::class, 'aqg')->getAllUserNameNotUsedInSteamKey();

        $listeKeys = $doctrine
            ->getRepository(SteamKeys::class)
            ->findAll();

        return $this->render('KeysTable.html.twig', ['listeKeys' => $listeKeys, 'username' => $username]);
    }
    #[Route('/account', name: 'account')]
    public function account(ManagerRegistry $doctrine)
    {
        $listeAccount = $doctrine
            ->getRepository(Account::class)
            ->findAll();

        return $this->render('UserTable.html.twig', ['listeAccount' => $listeAccount]);
    }
}
