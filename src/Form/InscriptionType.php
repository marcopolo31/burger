<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class InscriptionType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, $this->getConfiguration("Pseudo","Veuillez saisir votre Pseudo..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email","Veuillez saisir votre email..."))
            ->add('password',PasswordType::class, $this->getConfiguration("Mot de passe","Veuillez saisir votre mot de passe"))
            ->add('verifPassword',PasswordType::class, $this->getConfiguration("Confirmation de Mot de passe","Confirmez votre mot de passe"))
            ->add('picture', UrlType::class, $this->getConfiguration("Image Url", "Mettez une Url d'image de vous ou pas...",["required" => False]))

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
