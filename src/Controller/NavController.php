<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\aqg\Account;
use App\Entity\aqg\Quizinformations;
use App\Entity\aqg\Reports;

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
        return $this->render('Dashboard.html.twig',[
            "user_count" => $userCount['number'],
            "quiz_count" => $quizCount['number'],
            "play_count" => $playCount['number'],
            "reports_count" => $reportsCount['number']
        ]);
    }
    #[Route('/quizList', name: 'quizList')]
    public function quizList()
    {
        return $this->render('QuizTable.html.twig');
    }
}
