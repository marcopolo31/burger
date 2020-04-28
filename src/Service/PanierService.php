<?php

namespace App\Service;

use App\Repository\MenuRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService{

    protected $session;
    protected $menuRepository;

    public function __construct(SessionInterface $session, MenuRepository $menuRepository)
    {
        $this->session = $session;
        $this->menuRepository = $menuRepository;

        
    }

    public function add(int $id){
        $panier = $this->session->get('panier', []);

        if(!empty($panier[$id]))
        {
            $panier[$id]++;
        }
        else
        {
            $panier[$id] = 1;
        }

        
        $this->session->set('panier', $panier);

    }

    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);
      
      if(!empty($panier[$id])){
          unset($panier[$id]);
      }

      $this->session->set('panier', $panier);

    }

    public function getFullPanier() : array{
        $panier = $this->session->get('panier', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity){
            $panierWithData[] = [
                'menu' => $this->menuRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $panierWithData;

    }

    public function getTotal() : float
    {
        $total = 0;

        foreach($this->getFullPanier() as $item){
            $total += $item['menu']->getPrix() * $item['quantity'];
        }

        return $total;
    }
}