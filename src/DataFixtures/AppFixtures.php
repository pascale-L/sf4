<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i <10; $i++){
            $user = new User();

            $hash = $this->passwordEncoder->encodePassword($user, 'user' . $i);

            $user
            

        }

        $manager->flush();
    }
}
