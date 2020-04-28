<?php

namespace App\Controller;

use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(PanierService $panierService)
    {
        return $this->render('panier/panier.html.twig', [
            'items' => $panierService->getFullPanier(),
            'total' => $panierService->getTotal()
            
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id, PanierService $panierService)
    {
        $panierService->add($id);
        
        return $this->redirectToRoute("panier");

    }

    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, PanierService $panierService)
    {
      $panierService->remove($id);

      return $this->redirectToRoute("panier");
        
    

    }
}
