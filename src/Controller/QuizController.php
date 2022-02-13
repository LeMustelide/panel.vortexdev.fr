<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\aqg\Quizinformations;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz/{quizId}", name="quiz")
     */
    public function quiz(string $quizId, ManagerRegistry $doctrine): Response
    {
        $Quiz = $doctrine
            ->getRepository(Quizinformations::class)
            ->find($quizId);
        $name = $Quiz->getName();
        return $this->render('Profile.html.twig', [
            'quiz_name' => $name
        ]);
    }
}
