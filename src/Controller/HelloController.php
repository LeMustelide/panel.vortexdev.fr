<?php

// src/Controller/HelloController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * Hello world, avec Twig cette fois 🙂
     *
     * @Route("/hello/{name}", name="hello")
     */
    public function hello($name)
    {
        return $this->render('hello.html.twig', ['name' => $name]);
    }

    /**
     * Hello world, avec Twig cette fois 🙂
     *
     * @Route("/")
     */
    public function voirForm()
    {
        return $this->render('login.html.twig');
    }
}