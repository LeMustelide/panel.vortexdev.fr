<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\panel\UserRepository;
use App\Repository\panel\ActionTypeRepository;
use App\Entity\panel\Sanction;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class AccountController extends AbstractController
{    
    #[Route('/account/ban/{steamId}', name: 'banAccount', priority: 2)]
    public function ban(string $steamId, Request $request, ManagerRegistry $doctrine, ActionTypeRepository $actionType, Security $security, UserRepository $users)
    {
        date_default_timezone_set('Europe/Paris');
        $entityManager = $doctrine->getManager();

        $date = new \DateTime('now');
        $reason = $request->request->get("reason");
        $Type = $actionType->find(1);
        $user = $security->getUser();
        $userId = $user->getId();

        $user = $users->find($userId);
        
        $ban = new Sanction();
        $ban->setReason($reason);
        $ban->setAction($Type);
        $ban->setSteamId($steamId);
        $ban->setDate($date);
        $ban->setUser($user);

        $entityManager->persist($ban);
        $entityManager->flush();

        return $this->redirect('/Profile/'.$steamId);
    }

    #[Route('/account/unban/{steamId}', name: 'unbanAccount', priority: 2)]
    public function unban(string $steamId, ManagerRegistry $doctrine, ActionTypeRepository $actionType, Security $security, UserRepository $users)
    {
        date_default_timezone_set('Europe/Paris');
        $entityManager = $doctrine->getManager();

        $date = new \DateTime('now');
        $Type = $actionType->find(2);
        $user = $security->getUser();
        $userId = $user->getId();

        $user = $users->find($userId);
        
        $ban = new Sanction();
        $ban->setAction($Type);
        $ban->setSteamId($steamId);
        $ban->setDate($date);
        $ban->setUser($user);

        $entityManager->persist($ban);
        $entityManager->flush();

        return $this->redirect('/Profile/'.$steamId);
    }

    #[Route('/account/warn/{steamId}', name: 'warnAccount', priority: 2)]
    public function warn(string $steamId, Request $request, ManagerRegistry $doctrine, ActionTypeRepository $actionType, Security $security, UserRepository $users)
    {
        date_default_timezone_set('Europe/Paris');
        $entityManager = $doctrine->getManager();

        $date = new \DateTime('now');
        $reason = $request->request->get("reason");
        $user = $security->getUser();
        $userId = $user->getId();
        $Type = $actionType->find(0);

        $user = $users->find($userId);
        
        $warn = new Sanction();
        $warn->setAction($Type);
        $warn->setReason($reason);
        $warn->setSteamId($steamId);
        $warn->setDate($date);
        $warn->setUser($user);

        $entityManager->persist($warn);
        $entityManager->flush();

        return $this->redirect('/Profile/'.$steamId);
    }
}