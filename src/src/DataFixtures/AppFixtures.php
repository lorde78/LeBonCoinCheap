<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\AnswerFactory;
use App\Factory\ArticleFactory;
use App\Factory\QuestionFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use function Zenstruck\Foundry\factory;

class AppFixtures extends Fixture {
  public function load( ObjectManager $manager )
  : void {


    UserFactory::createMany( 10 );
    ArticleFactory::createMany( 10, function () {
      return [
          'idUser' => UserFactory::random(),
      ];
    } );
    QuestionFactory::createMany( 10, function () {
      return [
          'idUser'    => UserFactory::random(),
          'idArticle' => ArticleFactory::random(),
      ];
    } );


    AnswerFactory::createMany( 10, function () {
      return [
          'idQuestion' => QuestionFactory::random(),
          'idUser'     => UserFactory::random(),
      ];
    } )
      // $user->setEmail()
      //  ->setName()
      //  ->setNickName()

    ;
    //je suis dans la page 112

    //$manager->flush();

  }
}
