<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MenuRepository $repository)
    {   
        $menus = $repository->findAll();
        return $this->render('home/index.html.twig', [
            'menus' => $menus,
        ]);
    }
}
