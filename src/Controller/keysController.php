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
use App\Entity\panel\SteamKeys;
use App\Entity\aqg\Account;

class keysController extends AbstractController
{
    /**
     * @Route("/keys", name="keys")
     */
    public function keys(ManagerRegistry $doctrine, Session $session): Response
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $username = $customerEntityManager->getRepository(Account::class, 'aqg')->getAllUserName();

        $listeKeys = $doctrine
            ->getRepository(SteamKeys::class)
            ->findAll();

        return $this->render('KeysTable.html.twig', ['listeKeys' => $listeKeys, 'username' => $username]);
    }

    /**
     * @Route("/keys/delKey", name="delKey")
     */
    public function delKey(ManagerRegistry $doctrine, Request $request, Session $session): Response
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $username = $customerEntityManager->getRepository(Account::class, 'aqg')->getAllUserName();

        $listeKeys = $doctrine
            ->getRepository(SteamKeys::class)
            ->findAll();

        $entityManager = $doctrine->getManager();

        $keys = $request->request->get("key");

        $listeKeys2 = $doctrine
            ->getRepository(SteamKeys::class)
            ->find($keys);



        $entityManager->remove($listeKeys2);
        $entityManager->flush();

        return $this->render('KeysTable.html.twig', ['listeKeys' => $listeKeys, 'username' => $username]);
    }

    /**
     * @Route("/keys/addKey", name="addKey")
     */
    public function addKey(ManagerRegistry $doctrine, Request $request, Session $session): Response
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $username = $customerEntityManager->getRepository(Account::class, 'aqg')->getAllUserName();

        date_default_timezone_set('Europe/Paris');
        $listeKeys = $doctrine
            ->getRepository(SteamKeys::class)
            ->findAll();

        $entityManager = $doctrine->getManager();

        $steamKey = $request->request->get("steamKey");
        $description = $request->request->get("description");
        $tag = $request->request->get("tag");
        $steamId = $request->request->get("steamId");
        $date = new \DateTime('now');

        $key = new SteamKeys();

        $key->setSteamKey($steamKey);
        $key->setdescription($description);
        $key->settag($tag);
        $key->setSteamId($steamId);
        $key->setdate($date);

        $entityManager->persist($key);
        $entityManager->flush();

        return new Response('Saved new product with id ');
    }
}
