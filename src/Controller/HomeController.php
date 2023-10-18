<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return new Response('Bonjour mes étudiants');
    }
    #[Route('/msg/{name}', name: 'msg')]
    public function msg($name)
    {
        return $this ->render('home/msg.html.twig', [
            'n' => $name,
        ]);
    }
    
    
}

