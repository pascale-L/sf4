<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Instanciation de Faker
       $faker = Factory::create('fr_FR');

       for ($i = 0; $i <10; $i++){
        $commentaire = new Commentaire();

        $commentaire
            ->setAuteur($faker->name())
            ->setCommentaire($faker->text())
            ->setCreation($faker->dateTime());

            // Récupération aléatoire d'un commentaire par une référence
            $annonceReference = 'annonce_' . $faker->numberBetween(0 ,9);
            $annonce= $this->getReference($annonceReference);

            $commentaire->setAnnonce($annonce);
            
        //persist = comme un git add
        $manager->persist($commentaire);

        
    }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
               
               AnnonceFixtures::class
              
        ];

    }
}
