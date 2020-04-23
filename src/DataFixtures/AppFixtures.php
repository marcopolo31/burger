<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {   
        $cat1 = new Categorie();
        $cat1->setNom("Menu");
        $manager->persist($cat1);

        $cat2 = new Categorie();
        $cat2->setNom("Burger");
        $manager->persist($cat2);

        $cat3 = new Categorie();
        $cat3->setNom("Snack");
        $manager->persist($cat3);

        $cat4 = new Categorie();
        $cat4->setNom("Salade");
        $manager->persist($cat4);

        $cat5 = new Categorie();
        $cat5->setNom("Boisson");
        $manager->persist($cat5);

        $cat6 = new Categorie();
        $cat6->setNom("Dessert");
        $manager->persist($cat6);
        
        $m1 = new Menu();
        $m1->setNom("Menu Classic")
            ->setDescription("Burger: Steak, Salade, Tomate, Cornichon + Frites + Boisson ")
            ->setPrix(7.50)
            ->setImage("m1.png")
            ->setCategorie($cat1)
            
            ;
        $manager->persist($m1);

        $m2 = new Menu();
        $m2->setNom("Menu Bacon")
            ->setDescription("Burger: Bacon, Salade, Tomate, Cornichon + Frites + Boisson ")
            ->setPrix(8.50)
            ->setImage("m2.png")
            ->setCategorie($cat1)
            
            ;
        $manager->persist($m2);

        $m3 = new Menu();
        $m3->setNom("Menu King")
            ->setDescription("Burger: Steak, Salade, Tomate, Cornichon, oignon + Frites + Boisson ")
            ->setPrix(7.30)
            ->setImage("m3.png")
            ->setCategorie($cat1)
            
            ;
        $manager->persist($m3);

        $m4 = new Menu();
        $m4->setNom("Menu Long Chicken")
            ->setDescription("Burger: Poulet, Salade, Tomate, Cornichon + Frites + Boisson")
            ->setPrix(7.85)
            ->setImage("m4.png")
            ->setCategorie($cat1)
            
            ;
        $manager->persist($m4);

        $m5 = new Menu();
        $m5->setNom("Menu Chicken")
            ->setDescription("Burger: Poulet, Salade + Frites + Boisson ")
            ->setPrix(8.05)
            ->setImage("m5.png")
            ->setCategorie($cat1)
            
            ;
        $manager->persist($m5);

        $m6 = new Menu();
        $m6->setNom("Menu Triple X")
            ->setDescription("Burger:  3 Steaks, Salade, Tomate, Cornichon + Frites + Boisson ")
            ->setPrix(10.50)
            ->setImage("m6.png")
            ->setCategorie($cat1)
            
            ;
        $manager->persist($m6);


        $b1 = new Menu();
        $b1->setNom("Burger Classic")
            ->setDescription("Burger: Steak, Salade, Tomate, Cornichon")
            ->setPrix(5.50)
            ->setImage("b1.png")
            ->setCategorie($cat2)
            
            ;
        $manager->persist($b1);

        $b2 = new Menu();
        $b2->setNom("Burger Bacon")
            ->setDescription("Burger: Bacon, Salade, Tomate, Cornichon")
            ->setPrix(5.00)
            ->setImage("b2.png")
            ->setCategorie($cat2)
            
            ;
        $manager->persist($b2);

        $b3 = new Menu();
        $b3->setNom("Burger King")
            ->setDescription("Burger: Steak, Salade, Tomate, Cornichon")
            ->setPrix(4.50)
            ->setImage("b3.png")
            ->setCategorie($cat2)
            
            ;
        $manager->persist($b3);

        $s1 = new Menu();
        $s1->setNom("Frites")
            ->setDescription("Snack: Portion de Frites")
            ->setPrix(2.50)
            ->setImage("s1.png")
            ->setCategorie($cat3)
            
            ;
        $manager->persist($s1);

        $s2 = new Menu();
        $s2->setNom("Onion Rings")
            ->setDescription("Snack: Onion Rings")
            ->setPrix(2.00)
            ->setImage("s2.png")
            ->setCategorie($cat3)
            
            ;
        $manager->persist($s2);

        $s3 = new Menu();
        $s3->setNom("Nuggets")
            ->setDescription("Snack: Nuggets")
            ->setPrix(3.50)
            ->setImage("s3.png")
            ->setCategorie($cat3)
            
            ;
        $manager->persist($s3);

        $sa1 = new Menu();
        $sa1->setNom("Salade Cesar")
            ->setDescription("Salade : Salade, Tomate, Oeuf, oignons et Fromage")
            ->setPrix(7.00)
            ->setImage("sa1.png")
            ->setCategorie($cat4)
            
            ;
        $manager->persist($sa1);

        $sa2 = new Menu();
        $sa2->setNom("Salade chicken")
            ->setDescription("Salade : Poulet, Salade, Tomate")
            ->setPrix(6.50)
            ->setImage("sa2.png")
            ->setCategorie($cat4)
            
            ;
        $manager->persist($sa2);

        $sa3 = new Menu();
        $sa3->setNom("Salade Maison")
            ->setDescription("Salade : Salade, Tomate, Fromage")
            ->setPrix(8.10)
            ->setImage("sa3.png")
            ->setCategorie($cat4)
            
            ;
        $manager->persist($sa3);

        $bo1 = new Menu();
        $bo1->setNom("Coca-Cola")
            ->setDescription("Boisson:Coca-Cola")
            ->setPrix(2.10)
            ->setImage("bo1.png")
            ->setCategorie($cat5)
            
            ;
        $manager->persist($bo1);

        $bo2 = new Menu();
        $bo2->setNom("Coca-Light")
            ->setDescription("Boisson:Coca-Cola Light")
            ->setPrix(2.10)
            ->setImage("bo2.png")
            ->setCategorie($cat5)
            
            ;
        $manager->persist($bo2);

        $bo3 = new Menu();
        $bo3->setNom("Coca-Zéro")
            ->setDescription("Boisson:Coca-Cola Zéro")
            ->setPrix(1.99)
            ->setImage("bo3.png")
            ->setCategorie($cat5)
            
            ;
        $manager->persist($bo3);

        $d1 = new Menu();
        $d1->setNom("Fondant au chocolat")
            ->setDescription("Dessert: Fondant au chocolat à la chantilly")
            ->setPrix(3.10)
            ->setImage("d1.png")
            ->setCategorie($cat6)
            
            ;
        $manager->persist($d1);

        $d2 = new Menu();
        $d2->setNom("Muffins")
            ->setDescription("Dessert: Muffins")
            ->setPrix(2.08)
            ->setImage("d2.png")
            ->setCategorie($cat6)
            
            ;
        $manager->persist($d2);

        $d3 = new Menu();
        $d3->setNom("Donuts")
            ->setDescription("Dessert : Donuts au chocolat et vanille ")
            ->setPrix(2.25)
            ->setImage("d3.png")
            ->setCategorie($cat6)
            
            ;
        $manager->persist($d3);


        $manager->flush();
    }

}
