<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function accueil()
    {
        return $this->render('Dashboard.html.twig');
    }
    #[Route('/userList', name: 'userList')]
    public function userList()
    {
        return $this->render('UserTable.html.twig');
    }
    #[Route('/keysList', name: 'keysList')]
    public function keysList()
    {
        return $this->render('KeysTable.html.twig');
    }
    #[Route('/quizList', name: 'quizList')]
    public function quizList()
    {
        return $this->render('QuizTable.html.twig');
    }
}
