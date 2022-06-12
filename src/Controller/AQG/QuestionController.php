<?php

namespace App\Controller\AQG;

use App\Entity\aqg\Quizcontent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\aqg\QuizcontentRepository;
use App\Repository\aqg\AnswertypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\aqg\QuizinformationsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends AbstractController
{
    #[Route('question/{id}', name: 'questionDetails', priority: 2)]
    public function question(string $id, QuizcontentRepository $QuizContent)
    {
        $quizContent = $QuizContent->find($id);
        return $this->render('QuestionModify.html.twig', ['quizContent' => $quizContent, 'id' => $id]);
    }

    #[Route('question/modify/{id}', name: 'questionModify')]
    public function questionModify(ManagerRegistry $doctrine, Request $request, string $id, QuizcontentRepository $QuizContent, AnswertypeRepository $AnswerType)
    {
        $entityManager = $doctrine->getManager('aqg');

        $quizContent = $QuizContent->find($id);

        $timer = $request->request->get("time");
        if(!($request->request->get("enableTimer"))){
            $timer = 0;
        }
        $require = $request->request->get("require");
        $difficulty = $request->request->get("difficulty");
        
        
        $type = $request->request->get("type");
        $CorrectAnswer = 1;
        switch($type){
            case 1:
                $question = $request->request->get("questionTEXT");
                $answer1 = implode(";",$request->request->all()['textAnswer']);
                $answer2 = "";
                $answer3 = "";
                $answer4 = "";
                break;
            case 2:
                $question = $request->request->get("questionVF");
                $answer1 = $request->request->get("rep1VF");
                $answer2 = $request->request->get("rep2VF");
                $answer3 = "";
                $answer4 = "";
                break;
            case 3:
                $question = $request->request->get("questionQCM");
                $answer1 = $request->request->get("rep1QCM");
                $answer2 = $request->request->get("rep2QCM");
                $answer3 = $request->request->get("rep3QCM");
                $answer4 = $request->request->get("rep4QCM");
                $correct2 = $request->request->get("Correct2");
                $correct3 = $request->request->get("Correct3");
                if($correct2){
                    $CorrectAnswer = 2;
                }
                if($correct3){
                    $CorrectAnswer = 3;
                }
                break;
            default:
                $question = "";
                break;
        }

        $type = $AnswerType->find($type);

        $quizContent->setRequiredcorrectanswer($require);
        $quizContent->setDifficulty($difficulty);
        $quizContent->setTimer($timer);
        $quizContent->setType($type);
        $quizContent->setQuestion($question);
        $quizContent->setAnswer1($answer1);
        $quizContent->setAnswer2($answer2);
        $quizContent->setAnswer3($answer3);
        $quizContent->setAnswer4($answer4);
        $quizContent->setNumbercorrectanswer($CorrectAnswer);

        $entityManager->persist($quizContent);
        $entityManager->flush();

        //return new JsonResponse(array('rep' => $all));
        return $this->redirect('/question/'.$id);
    }

    #[Route('question/createForm/{id}', name: 'questionCreateForm')]
    public function questionCreateForm(string $id,)
    {
        return $this->render('QuestionCreate.html.twig', ['id' => $id]);
    }

    #[Route('question/create/{id}', name: 'questionCreate')]
    public function questionCreate(ManagerRegistry $doctrine, Request $request, string $id, AnswertypeRepository $AnswerType, QuizinformationsRepository $quizs)
    {
        $entityManager = $doctrine->getManager('aqg');

        $quizContent = new Quizcontent();

        $timer = $request->request->get("time");
        if(!($request->request->get("enableTimer"))){
            $timer = 0;
        }
        $difficulty = $request->request->get("difficulty");
        
        $type = $request->request->get("type");
        $CorrectAnswer = 1;
        $require = 1;
        switch($type){
            case 1:
                $question = $request->request->get("questionTEXT");
                $answer1 = implode(";",$request->request->all()['textAnswer']);
                $answer2 = "";
                $answer3 = "";
                $answer4 = "";
                break;
            case 2:
                $question = $request->request->get("questionVF");
                $answer1 = $request->request->get("rep1VF");
                $answer2 = $request->request->get("rep2VF");
                $answer3 = "";
                $answer4 = "";
                break;
            case 3:
                $require = $request->request->get("require");
                $question = $request->request->get("questionQCM");
                $answer1 = $request->request->get("rep1QCM");
                $answer2 = $request->request->get("rep2QCM");
                $answer3 = $request->request->get("rep3QCM");
                $answer4 = $request->request->get("rep4QCM");
                $correct2 = $request->request->get("Correct2");
                $correct3 = $request->request->get("Correct3");
                if($correct2){
                    $CorrectAnswer = 2;
                }
                if($correct3){
                    $CorrectAnswer = 3;
                }
                break;
            default:
                $question = "";
                break;
        }

        $type = $AnswerType->find($type);
        $quiz = $quizs->find($id);

        $quizContent->setQuizid($quiz);
        $quizContent->setRequiredcorrectanswer($require);
        $quizContent->setDifficulty($difficulty);
        $quizContent->setTimer($timer);
        $quizContent->setType($type);
        $quizContent->setQuestion($question);
        $quizContent->setAnswer1($answer1);
        $quizContent->setAnswer2($answer2);
        $quizContent->setAnswer3($answer3);
        $quizContent->setAnswer4($answer4);
        $quizContent->setNumbercorrectanswer($CorrectAnswer);
        $quizContent->setHint('');
        $quizContent->setExplanation('');
        $quizContent->setTolerance(0);

        $entityManager->persist($quizContent);
        $entityManager->flush();

        return $this->redirect('/quiz/'.$id);
    }
}
