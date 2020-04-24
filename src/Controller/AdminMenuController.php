<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminMenuController extends AbstractController
{
    /**
     * @Route("/admin/menu", name="admin_menu")
     */
    public function index(MenuRepository $repository)
    {
        $menus = $repository->findAll();
        return $this->render('admin_menu/adminMenu.html.twig', [
            'menus' => $menus,
        ]);
    }

    /**
     * @Route("/admin/modif/{id}", name="admin_modif")
     */
    public function modification(Menu $menu, Request $request, EntityManagerInterface $entityManager)
    {   
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($menu);
            $entityManager->flush();
            return $this->redirectToRoute("admin_menu");
        }

        return $this->render('admin_menu/adminModifAjout.html.twig', [
            'menu' => $menu,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/menu/{id}", name="suppression_menu", methods="SUP")
     */
    public function suppression(Menu $menu, Request $request, EntityManagerInterface $entityManager)
    {   
        if($this->isCsrfTokenValid("SUP".$menu->getId(), $request->get('_token')))
        {
            $entityManager->remove($menu);
            $entityManager->flush();
            return $this->redirectToRoute("admin_menu");
        }

    }
}
