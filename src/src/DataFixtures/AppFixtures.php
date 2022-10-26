<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\AnswerFactory;
use App\Factory\ArticleFactory;
use App\Factory\QuestionFactory;
use App\Factory\TagFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use function Zenstruck\Foundry\factory;

class AppFixtures extends Fixture {
  public function load( ObjectManager $manager )
  : void {

    TagFactory::createMany( 6 );
    UserFactory::createMany( 40 );
    ArticleFactory::createMany( 120, function () {
      return [
          'idUser' => UserFactory::random(),
          'idTag'  => TagFactory::random(),
      ];
    } );
    QuestionFactory::createMany( 20, function () {
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
