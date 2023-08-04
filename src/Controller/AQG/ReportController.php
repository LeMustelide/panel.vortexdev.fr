<?php

namespace App\Controller\AQG;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\aqg\ReportsRepository;
use App\Repository\aqg\AccountRepository;
use App\Repository\aqg\QuizinformationsRepository;
use App\Repository\aqg\ReportsStatusRepository;
use Doctrine\Persistence\ManagerRegistry;


class ReportController extends AbstractController
{
    #[Route('report/{id}', name: 'report')]
    public function report(string $id, ReportsRepository $Reports, AccountRepository $Accounts, QuizinformationsRepository $Quiz)
    {
        $Report = $Reports->find($id);
        $user = $Accounts->find($Report->getSteamid());
        if(!empty($Report->getQuizid()))
        {
            $quiz = $Quiz->find($Report->getQuizid());
        }
        else
        {
            $quiz = 'Aucun';
        }
        return $this->render('ReportDetails.html.twig', ['Report' => $Report, 'user' => $user, 'quiz' => $quiz]);
    }

    #[Route('report/solve/{id}', name: 'solveReport')]
    public function solve(string $id, ManagerRegistry $doctrine, ReportsRepository $Reports, ReportsStatusRepository $ReportsStatus)
    {
        $entityManager = $doctrine->getManager('aqg');
        $Report = $Reports->find($id);
        $Report->setStatus($ReportsStatus->find('Résolu'));
        $entityManager->persist($Report);
        $entityManager->flush();

        return $this->redirectToRoute('reportList');
    }

    #[Route('report/close/{id}', name: 'closeReport')]
    public function close(string $id, ManagerRegistry $doctrine, ReportsRepository $Reports, ReportsStatusRepository $ReportsStatus)
    {
        $entityManager = $doctrine->getManager('aqg');
        $Report = $Reports->find($id);
        $Report->setStatus($ReportsStatus->find('Sans suite'));
        $entityManager->persist($Report);
        $entityManager->flush();

        return $this->redirectToRoute('reportList');
    }

    #[Route('report/delete/{id}', name: 'deleteReport')]
    public function delete(string $id, ManagerRegistry $doctrine, ReportsRepository $Reports, ReportsStatusRepository $ReportsStatus)
    {
        $entityManager = $doctrine->getManager('aqg');
        $Report = $Reports->find($id);
        $entityManager->remove($Report);
        $entityManager->flush();

        return $this->redirectToRoute('reportList');
    }

    #[Route('report/reopen/{id}', name: 'reopenReport')]
    public function reopen(string $id, ManagerRegistry $doctrine, ReportsRepository $Reports, ReportsStatusRepository $ReportsStatus)
    {
        $entityManager = $doctrine->getManager('aqg');
        $Report = $Reports->find($id);
        $Report->setStatus($ReportsStatus->find('En attente'));
        $entityManager->persist($Report);
        $entityManager->flush();

        return $this->redirectToRoute('reportList');
    }
}