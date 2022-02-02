<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Constraints as Assert;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\aqg\Account;

class AccountController extends AbstractController
{
    /**
     * @Route("/Account", name="Account")
     */
    public function Account(ManagerRegistry $doctrine, Session $session): Response
    {
        $listeAccount = $doctrine
                            ->getRepository(Account::class)
                            ->findAll();

    return $this->render('UserTable.html.twig', ['listeAccount' => $listeAccount]);
    }

}