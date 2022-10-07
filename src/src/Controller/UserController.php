<?php

namespace App\Controller;
// Exit if accessed directly
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController {

  /**
   * UserController constructor.
   */
  public function __construct() {
    // Do something
  }

  /**
   * @param EntityManagerInterface $entity_manager
   *
   * @return \Symfony\Component\HttpFoundation\Response
   * @Route("/basilmoche", name="app_test")
   */
  public function show( EntityManagerInterface $entity_manager ) {

    return $this->render( 'question/homepage.html.twig', [
        'test' => 'eeeeeeeeeeee',
    ] );

  }


}
