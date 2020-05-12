<?php

namespace App\Controller;


use App\Form\AccountType;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Entity\PasswordUpdate;
use App\Form\PasswordUpdateType;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * Permet de se connecter
     * 
     * @Route("/login", name="login")
     * 
     * 
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

            $this->addFlash(
                'success',
                "Votre compte a bien été crée ! Vous pouvez maintenant vous connecter"
            );

            return $this->redirectToRoute("login");

            
        }
        return $this->render('admin/inscription.html.twig', [
            'form' => $form->createView(),
            
        ]);


    }

     /**
     * @Route("/logout", name="logout")
     */
    public function deconnexion()
    {
        return $this->redirectToRoute("home");
           
    }


    /**
     * Permet afficher et de traiter le formulaire de modification de profil
     * 
     * @Route("/account/profile", name="account_profile")
     *
     * 
     * @return Response
     */
    public function profile(Request $request, EntityManagerInterface $manager){

        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les nouvelles données ont bien été prises en compte !"
            );

            return $this->redirectToRoute("account_index");
        }

        return $this->render('user/modifProfil.html.twig', [
            'form' => $form->createView(),
            
        ]);

    }

    /**
     * Permet de modifier le mot de passe
     * 
     * @Route("/account/update-password", name="account_password")
     * 
     *
     * @return void
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager){
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())){

                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel !"));

            }else{
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a été modifié !"
                );

                return $this->redirectToRoute("home");
                }
            
        }

        return $this->render('user/password.html.twig', [
            'form' => $form->createView(),
            
        ]);

    }

    /**
     * permet afficher profil connecter
     * 
     * @Route("/account", name="account_index")
     * 
     * 
     * @return Response
     */
    public function myAccount(){
        return $this->render('user/profil.html.twig', [
            'user' => $this->getUser()
        ]);
    }
    
}
