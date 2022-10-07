<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture {
  public function load( ObjectManager $manager )
  : void {

   // $user->setEmail()
    //  ->setName()
    //  ->setNickName()

    ;
      //je suis dans la page 112

        //$manager->flush();

    UserFactory::createMany(10);
    }
}
