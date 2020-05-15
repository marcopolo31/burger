<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Page Accueil
     * 
     * @Route("/", name="home")
     * 
     * @return void
     */
    public function index()
    {   
        
        return $this->render('home/index.html.twig');
    }
}
