<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\aqg\AccountRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\aqg\Account;

class AccountController extends AbstractController
{
    #[Route('/account/ban/{steamId}', name: 'banAccount', priority: 2)]
    public function ban(string $steamId, ManagerRegistry $doctrine, AccountRepository $Accounts)
    {
        $entityManager = $doctrine->getManager('aqg');
        $Account = $Accounts->find($steamId);
        $Account->setBan(true);

        $entityManager->persist($Account);
        $entityManager->flush();

        return $this->redirect('/Profile/'.$steamId);
    }

    #[Route('/account/unban/{steamId}', name: 'unbanAccount', priority: 2)]
    public function unban(string $steamId, ManagerRegistry $doctrine, AccountRepository $Accounts)
    {
        $entityManager = $doctrine->getManager('aqg');
        $Account = $Accounts->find($steamId);
        $Account->setBan(false);

        $entityManager->persist($Account);
        $entityManager->flush();

        return $this->redirect('/Profile/'.$steamId);
    }
}