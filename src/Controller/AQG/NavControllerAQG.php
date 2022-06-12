<?php

namespace App\Controller\AQG;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Entity\panel\SteamKeys;
use App\Document\Log as aqgLog;
use App\Repository\aqg\QuizinformationsRepository;
use App\Repository\aqg\AccountRepository;
use App\Repository\aqg\ReportsRepository;
use App\Repository\aqg\ApikeyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class NavControllerAQG extends AbstractController
{
    #[Route('/', name: 'dashboardAQG')]
    public function dashboard(DocumentManager $dm, AccountRepository $Account, QuizinformationsRepository $Quizinformations, ReportsRepository $Report, HttpClientInterface $client)
    {
        $userCount = $Account->getUserCount();
        $quizCount = $Quizinformations->getQuizCount();
        $playCount = $Account->getPlayCount();

        // Connexions par mois
        $mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Decembre");
        $date = date('Y-m-01');
        $dates = array();
        $playCounts = array();
        for ($i=0; $i<=12; $i++) {
            array_push($playCounts, 
            count(($dm->createQueryBuilder(aqgLog::class)
            ->field('timestamp')->range(strtotime(date("Y-m-d", strtotime ( '-'.strval($i).' month', strtotime($date)))), strtotime(date("Y-m-d", strtotime ( '-'.strval($i-1).' month', strtotime($date)))))
            ->field('url')->equals('/user/create')
            ->getQuery()
            ->execute())->toArray()));
            array_push($dates,$mois[intval(date("m", strtotime ( '-'.strval($i-1).' month', strtotime($date))))-1]);
        }
        array_shift($dates);

        // Joueurs connectés
        $request = $client->request('GET', 'https://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v1/?key=D86656B23A1617F7ADDA7E7C96632494&appid=1574060');
        $response = ($request->toArray(false))['response'];
        $connected = $response['player_count'];

        $reportsCount = $Report->getReportsIsWaiting();
        return $this->render('Dashboard.html.twig', [
            "connected" => $connected,
            "user_count" => $userCount['number'],
            "play_counts" => $playCounts,
            "dates" => $dates,
            "quiz_count" => $quizCount['number'],
            "play_count" => $playCount['number'],
            "reports_count" => $reportsCount['number']
        ]);
        //return new JsonResponse($response['player_count']);
    }

    #[Route('quizList/{size}/{page}', name: 'quizList', defaults: ['size' => 10, 'page' => 1])]
    public function quizList(int $size, int $page, QuizinformationsRepository $Quizinformations, PaginatorInterface $paginator, Request $request)
    {
        $quizList = $Quizinformations->getQuizList();
        $pagination = $paginator->paginate(
            $quizList, /* query NOT result */
            $request->query->getInt('page', $page), /*page number*/
            $size /*limit per page*/
        );

        return $this->render('QuizTable.html.twig', ['quizList' => $quizList, 'page' => $page, 'size' => $size, 'pagination' => $pagination]);
    }

    #[Route('keys/{size}/{page}', name: 'keys', defaults: ['size' => 10, 'page' => 1])]
    public function keys(int $size, int $page, ManagerRegistry $doctrine, AccountRepository $Accounts, PaginatorInterface $paginator, Request $request)
    {
        $username = $Accounts->getAllUserNameNotUsedInSteamKey();
        $allUsername = $Accounts->getAllUserName();

        $listeKeys = $doctrine->getRepository(SteamKeys::class)
            ->findAll();
        $pseudo = array();
        
        foreach($listeKeys as $key){
            $account = $Accounts->find($key->getSteamId());
            if($account){ 
                $name = $account->getUsername();
            }
            else{
                $name = '';
            }
            $pseudo[$key->getId()] = ($name);
        }

        $pagination = $paginator->paginate(
            $listeKeys, /* query NOT result */
            $request->query->getInt('page', $page), /*page number*/
            $size /*limit per page*/
        );

        return $this->render('KeysTable.html.twig', ['size' => $size, 'page' => $page,'listeKeys' => $listeKeys, 'pseudo' => $pseudo, 'username' => $username, 'allUsername' => $allUsername, 'pagination' => $pagination]);
    }

    #[Route('account/{size}/{page}', name: 'account', defaults: ['size' => 10, 'page' => 1])]
    public function account(int $size, int $page, AccountRepository $Account, PaginatorInterface $paginator, Request $request)
    {
        $listeAccount = $Account->getAccountList();
        $pagination = $paginator->paginate(
            $listeAccount, /* query NOT result */
            $request->query->getInt('page', $page), /*page number*/
            $size /*limit per page*/
        );

        return $this->render('UserTable.html.twig', ['page' => $page, 'size' => $size, 'listeAccount' => $listeAccount, 'pagination' => $pagination]);
    }

    #[Route('reportList/{size}/{page}/{filter}', name: 'reportList', defaults: ['size' => 10, 'page' => 1, 'filter' => 'all'])]
    public function reportList(int $size, int $page, string $filter, ReportsRepository $report, PaginatorInterface $paginator, Request $request)
    {
        $reportList = $report->getReportList($filter);
        $pagination = $paginator->paginate(
            $reportList, /* query NOT result */
            $request->query->getInt('page', $page), /*page number*/
            $size /*limit per page*/
        );

        return $this->render('ReportTable.html.twig', ['size' => $size, 'page' => $page, 'pagination' => $pagination, 'filter' => $filter]);
    }

    #[Route('versionList/{size}/{page}', name: 'versionList', defaults: ['size' => 10, 'page' => 1])]
    public function versionList(int $size, int $page, ApikeyRepository $apiKey, PaginatorInterface $paginator, Request $request)
    {
        $keyList = $apiKey->getKeyList($size, $page);
        $pagination = $paginator->paginate(
            $keyList, /* query NOT result */
            $request->query->getInt('page', $page), /*page number*/
            $size /*limit per page*/
        );

        return $this->render('versionTable.html.twig', ['page' => $page, 'size' => $size, 'pagination' => $pagination]);
    }

    #[Route('log/{page}', name: 'log', defaults: ['page' => 1])]
    public function log(int $page, DocumentManager $dm, PaginatorInterface $paginator, Request $request)
    {
        $size = 100;
        $find = $request->request->get('search');

        $log = $dm->createQueryBuilder(aqgLog::class)
            ->field('url')->where('function(){ var pattern = /.*'.str_replace('/', '\\/', $find).'.*/; return pattern.test(this.url); }')
            ->sort('_id', 'desc')
            ->getQuery();
        $pagination = $paginator->paginate(
            $log,
            $request->query->getInt('page', $page), 
            $size 
        );

        return $this->render('Log.html.twig', ['page' => $page, 'find' => $find, 'size' => $size, 'pagination' => $pagination]);
        //return new JsonResponse($find);
    }
}
