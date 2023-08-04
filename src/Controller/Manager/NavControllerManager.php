<?php

namespace App\Controller\Manager;

use App\Repository\panel\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NavControllerManager extends AbstractController
{
    #[Route('/logout0', name: 'logout0')]
    public function logout(int $size, int $page, UserRepository $Users, PaginatorInterface $paginator, Request $request)
    {

        $usersList = $Users->findAll();

        $pagination = $paginator->paginate(
            $usersList, /* query NOT result */
            $request->query->getInt('page', $page), /*page number*/
            $size /*limit per page*/
        );
        return $this->render('manager.html.twig', []);
    }
}
