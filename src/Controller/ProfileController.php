<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\aqg\AccountRepository;
use App\Repository\panel\SanctionRepository;

class ProfileController extends AbstractController
{
    /**
     * @Route("/Profile/{steamId}", name="profile")
     */
    public function profile(string $steamId, AccountRepository $Accounts, SanctionRepository $Sanctions): Response
    {   
        $Account = $Accounts->getAccountDetails($steamId);
        $reportsCount = $Accounts->getReportCount($steamId);
        $Sanction = $Sanctions->findBy(['steamid' => $steamId]);
        //$Sanctions = $Accounts->getSanctions($steamId);
        return $this->render('Profile.html.twig', [
            'account' => $Account,
            'reportsCount'=> $reportsCount,
            'sanctions' => $Sanction
        ]);
    }
}
