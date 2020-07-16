<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    /** @var UserPasswordEncoderInterface */ 
    private $passwordEncoder;

    /**
     * Dans la majorité des classes, on peut récupérer des services par autowiring
     * uniquement dans le constructeur
     * UserFixtures constructor.
     */

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }

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
                ->setPassword($hash)
                ->setRoles(['ROLE_USER'])
                ->setName($faker->name())
                ->setDescription($faker->text)
                ->setPseudo($faker->userName)
                ->setTelephone($faker->phoneNumber())
                ->setInscription($faker->dateTime());

            //persist = comme un git add
            $manager->persist($user);


        }
        // création d'administrateurs
        for ($i = 0; $i < 3; $i++){
              $admin = new User();

              $hash = $this->passwordEncoder->encodePassword($admin, 'admin' . $i);

              $admin
                    ->setEmail('admin' . $i . '@mail.org')
                    ->setPassword($hash)
                    ->setRoles(['ROLE_ADMIN'])
                    ->setName($faker->name())
                    ->setDescription($faker->text)
                    ->setPseudo($faker->userName)
                    ->setTelephone($faker->phoneNumber())
                    ->setInscription($faker->dateTime());

                    //persist = comme un git add
                $manager->persist($admin);


        }

        // création modérateur
        for ($i =0; $i < 3; $i++){
            $moderateur = new User();
            
             // Hash du mot de passe
             $hash = $this->passwordEncoder->encodePassword($moderateur, 'moderateur' . $i);

             $moderateur
                 ->setEmail('moderateur' . $i . '@mail.org')
                 ->setPassword($hash)
                 ->setRoles(['ROLE_MODERATEUR'])
                 ->setName($faker->name())
                ->setDescription($faker->text)
                ->setPseudo($faker->userName)
                ->setTelephone($faker->phoneNumber())
                ->setInscription($faker->dateTime());
 
                 //persist = comme un git add
                 $manager->persist($moderateur);

        }

        $manager->flush();
    }
}
