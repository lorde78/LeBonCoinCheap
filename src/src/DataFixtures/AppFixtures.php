<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture {
  public function load( ObjectManager $manager )
  : void {
    $user = new User();
   // $user->setEmail()
    //  ->setName()
    //  ->setNickName()

         $manager->persist( $user );
      //je suis dans la page 112

        $manager->flush();
    }
}
