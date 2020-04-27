<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class AdminMenuController extends AbstractController
{
    /**
     * @Route("/admin/menu", name="admin_menu")
     */
    public function index(MenuRepository $repository, PaginatorInterface $paginator, Request $request)
    {
        $menu = new Menu();
        $menus = $paginator->paginate(
            $repository->findAllWithPagination($menu),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('admin_menu/adminMenu.html.twig', [
            'menus' => $menus,
        ]);
    }

    /**
     * @Route("/admin/creation", name="admin_create")
     * @Route("/admin/modif/{id}", name="admin_modif", methods="GET|POST")
     */
    public function modification(Menu $menu = null, Request $request, EntityManagerInterface $entityManager, UploaderHelper $uploaderHelper, CacheManager $cacheManager)
    {   
        if(!$menu){
            $menu = new Menu();
        }

        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if($menu->getImageFile()instanceof UploadedFile)
            {
                $cacheManager->remove($uploaderHelper->asset($menu, 'imageFile'));
            }

            $entityManager->persist($menu);
            $entityManager->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_menu");
        }

        return $this->render('admin_menu/adminModifAjout.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
            
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
            $this->addFlash('danger', "Le produit a été supprimer");
            return $this->redirectToRoute("admin_menu");
        }

    }
}
