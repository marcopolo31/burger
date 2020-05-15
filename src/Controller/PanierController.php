<?php

namespace App\Controller;

use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * Affichage du Panier + montant
     * 
     * @Route("/panier", name="panier")
     * 
     * @return Response
     */
    public function index(PanierService $panierService)
    {
        return $this->render('panier/panier.html.twig', [
            'items' => $panierService->getFullPanier(),
            'total' => $panierService->getTotal()
            
        ]);
    }

    /**
     * Permet d'ajouter un article dans le panier
     * 
     * @Route("/panier/add/{id}", name="panier_add")
     * 
     * @return Response
     */
    public function add($id, PanierService $panierService)
    {
        $panierService->add($id);
        
        return $this->redirectToRoute("panier");

    }

    /**
     * Permet de supprimer un article dans le panier
     * 
     * @Route("/panier/remove/{id}", name="panier_remove")
     * 
     * @return Response
     */
    public function remove($id, PanierService $panierService)
    {
      $panierService->remove($id);

      return $this->redirectToRoute("panier");
        
    

    }

    /**
     * Affiche validation commande
     * 
     * @Route("/panier/command", name="panier_result")
     * 
     * @return void
     */
    public function result()
    {

        return $this->render('panier/result.html.twig');

    }
}
