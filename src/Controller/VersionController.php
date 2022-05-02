<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\aqg\ApikeyRepository;


class VersionController extends AbstractController
{
    #[Route('/version/delete', name: 'deleteVersion', priority: 2)]
    public function deleteVersion(ManagerRegistry $doctrine, Request $request, ApikeyRepository $Versions)
    {
        $entityManager = $doctrine->getManager('aqg');
        $id = $request->request->get("id");

        $version = $Versions->find($id);

        $entityManager->remove($version);
        $entityManager->flush();

        return $this->redirect('/versionList');
    }

    #[Route('/version/disable', name: 'disableVersion', priority: 2)]
    public function disableVersion(ManagerRegistry $doctrine, Request $request, ApikeyRepository $Versions)
    {
        $entityManager = $doctrine->getManager('aqg');
        $id = $request->request->get("id");

        $version = $Versions->find($id);

        $version->setDisable(1);

        $entityManager->persist($version);
        $entityManager->flush();

        return $this->redirect('/versionList');
    }

    #[Route('/version/enable', name: 'enableVersion', priority: 2)]
    public function enableVersion(ManagerRegistry $doctrine, Request $request, ApikeyRepository $Versions)
    {
        $entityManager = $doctrine->getManager('aqg');
        $id = $request->request->get("id");

        $version = $Versions->find($id);

        $version->setDisable(0);

        $entityManager->persist($version);
        $entityManager->flush();

        return $this->redirect('/versionList');
    }
}
