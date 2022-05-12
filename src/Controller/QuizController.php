<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\aqg\QuizinformationsRepository;
use App\Repository\aqg\AccountRepository;
use App\Repository\aqg\PublicquizRepository;
use App\Repository\aqg\QuizcontentRepository;
use App\Repository\aqg\ScoreboardRepository;
use App\Entity\aqg\Publicquiz;
use App\Entity\aqg\Quizinformations;


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

    #[Route('/quiz/delete', name: 'delQuiz', priority: 2)]
    public function delQuiz(ManagerRegistry $doctrine, Request $request, QuizinformationsRepository $Quiz)
    {
        $entityManager = $doctrine->getManager('aqg');
        $id = $request->request->get("id");
        $quiz = $Quiz->find($id);

        $entityManager->remove($quiz);
        $entityManager->flush();

        return $this->redirect('/quizList');
    }

    #[Route('/quiz/publish', name: 'publishQuiz', priority: 2)]
    public function publishQuiz(ManagerRegistry $doctrine, Request $request, QuizinformationsRepository $quizInformation)
    {
        $entityManager = $doctrine->getManager('aqg');
        $id = $request->request->get("id");

        $quizRef = $quizInformation->find($id);

        $publicQuiz = new Publicquiz($quizRef);

        $entityManager->persist($publicQuiz);
        $entityManager->flush();

        return $this->redirect('/quizList');
    }

    #[Route('/quiz/unpublish', name: 'unpublishQuiz', priority: 2)]
    public function unpublishQuiz(ManagerRegistry $doctrine, Request $request, PublicquizRepository $Public)
    {
        $entityManager = $doctrine->getManager('aqg');
        $id = $request->request->get("id");

        $publishQuiz = $Public->find($id);

        $entityManager->remove($publishQuiz);
        $entityManager->flush();

        return $this->redirect('/quizList');
    }

    #[Route('/quiz/editDetails', name: 'editDetailsQuiz', priority: 2)]
    public function editDetailsQuiz(ManagerRegistry $doctrine, Request $request, QuizinformationsRepository $quizInformation)
    {
        $entityManager = $doctrine->getManager('aqg');
        $id = $request->request->get("id");
        $name = $request->request->get("Title");
        $description = $request->request->get("Description");

        $quiz = $quizInformation->find($id);

        $quiz->setName($name);
        $quiz->setDescription($description);

        $entityManager->persist($quiz);
        $entityManager->flush();

        return $this->redirect('/quiz/'.$id);
    }

    #[Route('/quiz/createForm', name: 'createQuizForm', priority: 2)]
    public function createQuizForm()
    {
        return $this->render('QuizCreate.html.twig');
    }

    #[Route('/quiz/create', name: 'createQuiz', priority: 2)]
    public function QuizForm(ManagerRegistry $doctrine, Request $request, AccountRepository $Accounts)
    {
        $entityManager = $doctrine->getManager('aqg');
        date_default_timezone_set('Europe/Paris');

        $name = $request->request->get("title");
        $description = $request->request->get("description");
        $life = $request->request->get("lifes");
        $skip = $request->request->get("skip");
        $SteamID = $Accounts->find(0);
        $date = new \DateTime();

        $quiz = new Quizinformations();

        $quiz->setName($name);
        $quiz->setDescription($description);
        $quiz->setLifes($life);
        $quiz->setSkip($skip);
        $quiz->setSteamid($SteamID);

        $quiz->setDifficulty(0);
        $quiz->setSpecificorder(0);
        $quiz->setCreationdate($date);
        $quiz->setUpdatedate($date);

        $entityManager->persist($quiz);
        $entityManager->flush();

        $id = $quiz->getId();

        return $this->redirect('/quiz/'.$id);
    }
}
