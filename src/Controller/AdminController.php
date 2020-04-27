<?php

namespace App\Controller;


use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function connexion(AuthenticationUtils $util)
    {
        return $this->render('admin/login.html.twig', [
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, EntityManagerInterface $entitymanager, UserPasswordEncoderInterface $encoder)
    {   
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $passwordCrypte = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $utilisateur->setRoles("ROLE_USER");
            $entitymanager->persist($utilisateur);
            $entitymanager->flush();
            return $this->redirectToRoute("home");
        }

        return $this->render('admin/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/logout", name="logout")
     */
    public function deconnexion()
    {
        return $this->redirectToRoute("home");
           
    }
}
