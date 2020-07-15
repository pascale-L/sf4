<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Instanciation de Faker
       $faker = Factory::create('fr_FR');

        // Création d'utilisateurs classiques

        for ($i = 0; $i <10; $i++){
            $user = new User();

            $hash = $this->passwordEncoder->encodePassword($user, 'user' . $i);

            $user
                ->setEmail('user' . $i . '@mail.org')
                ->setPassword($hash);
                ->setRoles(['ROLE_USER']);
                ->setName($faker =)

            //persist = comme un git add
            $manager->persist($user);


        }
        // création d'administrateurs
        for ($i = 0; $i < 3; $i++){
              $admin = new User();
        }

        $manager->flush();
    }
}
