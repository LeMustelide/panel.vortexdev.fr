<?php
require 'vendor/autoload.php';
// index.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$url = $request->getPathInfo();
$response = new Response();

switch($url) {
    case '/':
        $response->setContent('Accueils');
        break;
    case '/admin':
        $response->setContent('Accès Espace Admin');
        break;
    default:
        $response->setStatusCode(Response::HTTP_NOT_FOUND);
}

$response->send();