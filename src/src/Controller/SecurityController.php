<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Security\EmptyAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class SecurityController extends AbstractController {

  /**
   * @Route("/login", name="app_login")
   */
  public function login()
  : Response {

    $this->addFlash( 'success login', 'Connexion réussie , bienvenue ! :)' );

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

  /**
   * @Route("/add_user", name="app_add_user")
   */
  public function test(
      Request $request,
      EntityManagerInterface $entityManager,
      UserPasswordHasherInterface $hasher,
      UserAuthenticatorInterface $authenticator,
      EmptyAuthenticator $loginFormAuthenticator,
  )
  : Response {


    $form = $this->createForm( RegistrationFormType::class );

    $form->handleRequest( $request );

    if ( $form->isSubmitted() && $form->isValid() ) {
      $newUser      = $form->getData();
      $passwordForm = $form['passwordForm']->getData();
      $newUser->setPassword( $hasher->hashPassword( $newUser, $passwordForm ) );
      $entityManager->persist( $newUser );
      $entityManager->flush();

      $this->addFlash('success', 'Inscription réussie , bienvenue ! :)');

      return $authenticator->authenticateUser(
          $newUser,
          $loginFormAuthenticator,
          $request
      );
    }


    return $this->render( 'user/index.html.twig', [
        'userForm' => $form->createView(),
        'test' => 'test'
    ] );
  }



  }