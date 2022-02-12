<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\aqg\Account;

class ProfileController extends AbstractController
{
    /**
     * @Route("/Profile/{steamId}", name="profile")
     */
    public function profile(string $steamId, ManagerRegistry $doctrine): Response
    {
        $Account = $doctrine
            ->getRepository(Account::class)
            ->find($steamId);
        $name = $Account->getUsername();
        $steamId = $Account->getSteamid();
        $bio = $Account->getBio();
        $lastConnection = $Account->getCreationDate();
        $creation = $Account->getCreationDate();
        $QuizPlayed = $Account->getQuizPlayed();
        $Win = $Account->getWin();
        $lose = $Account->getLose();
        $QuizCreated = $Account->getQuizCreated();
        return $this->render('Profile.html.twig', [
            'profile_name' => $name,
            'steamID' => $steamId,
            'biography' => $bio, 
            'last_activity' => $lastConnection,
            'first_activity' => $creation,
            'QuizPlayed' => $QuizPlayed,
            'Win' => $Win,
            'lose' => $lose,
            'QuizCreated' => $QuizCreated
        ]);
    }
}
