<?php

namespace App\Controller;


use App\Entity\Menu;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/categories/{id}", name="menu")
     */
    public function index(Categorie $categorie)
    
    {   
        return $this->render('menu/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    



}
