<?php

namespace App\Controller;


use App\Entity\Categorie;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * Permet afficher les articles
     * 
     * @Route("/categories/{id}", name="menu")
     * 
     * @return void
     */
    public function index(Categorie $categorie)
    
    {   
        return $this->render('menu/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    



}
