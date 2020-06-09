<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class PanierController extends AbstractController
{
    /**
     * Affichage du Panier + montant
     * 
     * @Route("/user/panier", name="panier")
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
     * @Route("/user/panier/add/{id}", name="panier_add")
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
     * @Route("/user/panier/remove/{id}", name="panier_remove")
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
     * @Route("/user/panier/command", name="panier_result")
     * 
     * @return void
     */
    public function result()
    {

        return $this->render('panier/result.html.twig');

    }

    
    /**
     * Affiche pdf commande
     * 
     * @Route("/user/panier/pdf", name="panier_pdf")
     * 
     * @return Response
     */
    public function pdf(PanierService $panierService)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled', TRUE);
        $pdfOptions->set('isHtml5ParserEnabled', TRUE);
        $pdfOptions->set('defaultfront', 'Arial');
        
        $dompdf = new Dompdf();

        $html = $this->renderView('panier/pdf.html.twig', [
            'items' => $panierService->getFullPanier(),
            'total' => $panierService->getTotal(),
        ]);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream("commande.pdf", [
            "Attachment" =>false
        ]);


    }
}
