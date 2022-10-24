<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController {

  /**
   * @Route("/login", name="app_login")
   */
  public function login()
  : Response {

    $this->addFlash('success login', 'Connexion réussie , bienvenue ! :)');

    return $this->render( 'security/login.html.twig', [
        'controller_name' => 'SecurityController',
    ] );
  }

  /**
   * @Route("/logout", name="app_logout")
   */
  public function logout()
  : void {
  }

}