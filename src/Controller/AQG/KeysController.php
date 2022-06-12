<?php

namespace App\Controller\AQG;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\panel\SteamKeys;

class KeysController extends AbstractController
{
    #[Route('keys/delete', name: 'delKey', priority: 2)]
    public function delKey(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $keys = $request->request->get("key");

        $listeKeys = $doctrine
            ->getRepository(SteamKeys::class)
            ->find($keys);

        $entityManager->remove($listeKeys);
        $entityManager->flush();

        return $this->redirect('/keys');
    }

    #[Route('keys/add', name: 'addKey', priority: 2)]
    public function add(ManagerRegistry $doctrine, Request $request, Session $session): Response
    {
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


        return $this->redirect('/keys');
    }

    #[Route('keys/modify', name: 'modifyKey', priority: 2)]
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
