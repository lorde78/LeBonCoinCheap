<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'HomeController' ) ) {

  /**
   * Class HomeController
   * @Route("/", name="app_homepagesss")
   */
  class HomeController {

    /**
     * HomeController constructor.
     */
    public function __construct() {
      // Do something
    }

    public function show() {
      return $this->render( 'question/homepage.html.twig', [
          'test' => 'cacac acac acacc acacac cacac acac ',
      ] );
    }

  }

  // Instantiate
  new HomeController();
}
