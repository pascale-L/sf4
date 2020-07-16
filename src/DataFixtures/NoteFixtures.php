<?php

namespace App\DataFixtures;

use App\Entity\Note;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class NoteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Instanciation de Faker
       $faker = Factory::create('fr_FR');

       for ($i = 0; $i <10; $i++){
        $note = new Note();

        $note
            ->setAuteur($faker->name())
            ->setUtilisateur($faker->userName)
            ->setNote($faker->numberBetween(0, 4))
            ->setAvis($faker->text())
            ->setCreation($faker->dateTime());
            
            
        //persist = comme un git add
        $manager->persist($note);

       }

        $manager->flush();
    }
}
