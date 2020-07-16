<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Instanciation de Faker
        $faker = Factory::create('fr_FR'); 
 
        for ($i = 0; $i <10; $i++){
         $categorie = new Categorie();
 
         $categorie
         ->setName($faker->name());

 
         //persist = comme un git add
         $manager->persist($categorie);

         // Définir une référence sur l'entité, pour la récupérer dans d'autres fixtures
         $reference = 'categorie_' . $i;
         $this->addReference($reference, $categorie);

        }
 

        $manager->flush();
    }
}
