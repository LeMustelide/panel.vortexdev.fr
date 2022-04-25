<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\panel\SteamKeys;
use App\Entity\aqg\Account;

class keysController extends AbstractController
{
    /**
     * @Route("/keys/delete", name="delKey")
     */
    public function delKey(ManagerRegistry $doctrine, Request $request, Session $session): Response
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $username = $customerEntityManager->getRepository(Account::class, 'aqg')->getAllUserNameNotUsedInSteamKey();

        $entityManager = $doctrine->getManager();

        $keys = $request->request->get("key");

        $listeKeys = $doctrine
            ->getRepository(SteamKeys::class)
            ->find($keys);

        $entityManager->remove($listeKeys);
        $entityManager->flush();

        $listeKeys = $doctrine
            ->getRepository(SteamKeys::class)
            ->find($keys);

        return $this->render('KeysTable.html.twig', ['listeKeys' => $listeKeys, 'username' => $username]);
    }

    #[Route('/keys/add', name: 'addKey', priority: 2)]
    public function add(ManagerRegistry $doctrine, Request $request, Session $session): Response
    {
        $customerEntityManager = $doctrine->getManager('aqg');
        $username = $customerEntityManager->getRepository(Account::class, 'aqg')->getAllUserNameNotUsedInSteamKey();

        date_default_timezone_set('Europe/Paris');

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

        $listeKeys = $doctrine
            ->getRepository(SteamKeys::class)
            ->findAll();

        return $this->render('KeysTable.html.twig', ['listeKeys' => $listeKeys, 'username' => $username]);
    }

    #[Route('/keys/modify', name: 'modifyKey', priority: 2)]
    public function modify(ManagerRegistry $doctrine, Request $request, Session $session): Response
    {
        $entityManager = $doctrine->getManager();

        $steamKey = $request->request->get("steamKey");
        $description = $request->request->get("description");
        $tag = $request->request->get("tag");
        $steamId = $request->request->get("steamId");
        $id = $request->request->get("id");

        $key = $doctrine->getRepository(SteamKeys::class)->find($id);

        $key->setSteamKey($steamKey);
        $key->setdescription($description);
        $key->settag($tag);
        $key->setSteamId($steamId);

        $entityManager->persist($key);
        $entityManager->flush();

        return $this->redirect('/keys');
    }
}
