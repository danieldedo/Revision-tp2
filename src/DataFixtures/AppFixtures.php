<?php

namespace App\DataFixtures;

use App\Entity\Livre;
use DateTimeInterface;
use App\Entity\Emprunt;
use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        $etudiant1 = new Etudiant();
        $etudiant1->setNom("Naruto");
        $etudiant1->setPrenom("Uzumaki");
        $etudiant1->setAdresse("4em rue des feux");
        $etudiant1->setEmail("nana@gmail.com");
        $etudiant1->setTel("+22958446685");
        $manager->persist($etudiant1);

        $etudiant2 = new Etudiant();
        $etudiant2->setNom("Sakura");
        $etudiant2->setPrenom("AROUNO");
        $etudiant2->setAdresse("10em rue des chameaux");
        $etudiant2->setEmail("saku@gmail.com");
        $etudiant2->setTel("+22956685855");
        $manager->persist($etudiant2);


        $livre1 = new Livre();
        $livre1->setTitre("Une si longue lettre");
        $livre1->setAuteur("Mariama BÂ");
        $livre1->setResume("Extraix des histoires affricaines...");
        $livre1->setDisponibilite("disponible");
        $livre1->setLocalisation("4em etagere du haut");
        $manager->persist($livre1);


        $livre2 = new Livre();
        $livre2->setTitre("La Secretaire particuliere");
        $livre2->setAuteur("Jean PLIYA");
        $livre2->setResume("Extraix des recits affricaines...");
        $livre2->setDisponibilite("disponible");
        $livre2->setLocalisation("12em etagere de la 3em colonne");
        $manager->persist($livre2);

        

        $emprunt1 = new Emprunt();
        $emprunt1->setLivre($livre1);
        $emprunt1->setEtudiant($etudiant1);
        // $emprunt1->setDateretourprevue("02/09/2023");
        $manager->persist($emprunt1);
        
        $emprunt2 = new Emprunt();
        $emprunt2->setLivre($livre2);
        $emprunt2->setEtudiant($etudiant2);
        // $date2 = new DateTimeInterface();
        // $date2->add(new DateInterval(""));
        // $emprunt2->setDateretourprevue($date2);
        $manager->persist($emprunt2);

        $manager->flush();
    }
}
