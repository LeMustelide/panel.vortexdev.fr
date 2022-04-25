<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\aqg\QuizinformationsRepository;
use App\Repository\aqg\AccountRepository;
use App\Repository\aqg\PublicquizRepository;
use App\Repository\aqg\QuizcontentRepository;
use App\Repository\aqg\ScoreboardRepository;


class QuizController extends AbstractController
{
    #[Route('/quiz/{quizid}', name: 'quiz')]
    public function quiz(string $quizid, AccountRepository $Accounts, QuizinformationsRepository $Quiz, PublicquizRepository $PublicQuiz, QuizcontentRepository $QuizContent, ScoreboardRepository $Score)
    {
        $quiz = $Quiz->find($quizid);
        $user = $Accounts->find($quiz->getSteamid());
        $publicQuiz = $PublicQuiz->find($quizid);
        $quizContent = $QuizContent->findBy(['quizid' => $quizid]);
        $scores = $Score->findBy(['quizid' => $quizid]);
        return $this->render('QuizDetails.html.twig', ['quiz' => $quiz, 'user' => $user, 'publicQuiz' => $publicQuiz, 'quizContent' => $quizContent, 'scores' => $scores]);
    }
}
