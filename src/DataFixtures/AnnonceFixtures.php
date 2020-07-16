<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AnnonceFixtures extends Fixture implements DependentFixtureInterface
{

 
    public function load(ObjectManager $manager)
    {
         // Instanciation de Faker
       $faker = Factory::create('fr_FR'); 

       for ($i = 0; $i <10; $i++){
        $annonce = new Annonce();

        $annonce
            ->setTitre($faker->title())
            ->setDescription($faker->text)
            ->setPrix($faker->numberBetween(0, 4))
            ->setVille($faker->city)
            ->setCodePostal($faker->postcode)
            ->setAdresse($faker->streetAddress)
            ->setCreation($faker->dateTime())
            ->setAuteur($faker->name());

            // Récupération aléatoire d'une catégorie par une référence
            $categorieReference = 'categorie_' . $faker->numberBetween(0, 3);
            $categorie= $this->getReference($categorieReference);

            $annonce->setCategorie($categorie);
            // Définir une référence sur l'entité, pour la récupérer dans d'autres fixtures
          $reference = 'annonce_' . $i;
          $this->addReference($reference, $annonce);

            


        //persist = comme un git add
        $manager->persist($annonce);


    }
        $manager->flush();
    }
    /**
     * Liste des classes de fixtures qui doivent être chargées avant celle-ci
     */

    public function getDependencies()
    {
        return [
               CategorieFixtures::class,
               
              
        ];

    }
}
