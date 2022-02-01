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
use App\Entity\panel\steamKeys;

class keysController extends AbstractController
{
    /**
     * @Route("/keys", name="keys")
     */
    public function keys(ManagerRegistry $doctrine, Session $session): Response
    {
        $listeKeys = $doctrine
                            ->getRepository(steamKeys::class)
                            ->findAll();

    return $this->render('KeysTable.html.twig', ['listeKeys' => $listeKeys]);
    }

        /**
     * @Route("/keys/supKeys", name="supKeys")
     */
    public function supKeys(ManagerRegistry $doctrine,Request $request, Session $session): Response
    {
        $listeKeys = $doctrine
                            ->getRepository(steamKeys::class)
                            ->findAll();

            $entityManager = $doctrine->getManager();
            
            $keys = $request->$request->get("type");

            $listeKeys2 = $doctrine
                                ->getRepository(steamKeys::class)
                                ->findOneBy($keys);

            $entityManager->remove($listeKeys2);
            $entityManager->flush();

    return $this->render('KeysTable.html.twig', ['listeKeys' => $listeKeys]);
    }
}