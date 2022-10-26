<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Security\EmptyAuthenticator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class UsersController extends AbstractController {
  #[Route( '/users', name: 'app_users' )]
  public function index()
  : Response {
    return $this->render( 'users/index.html.twig', [
        'controller_name' => 'UsersController',
    ] );
  }

  #[Route( '/new_user', name: 'app_new_user' )]
  public function new(
      Request $request,
      EntityManagerInterface $entityManager,
      UserPasswordHasherInterface $hasher,
      UserAuthenticatorInterface $authenticator,
      EmptyAuthenticator $loginFormAuthenticator
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

    return $this->render( 'users/user_new.html.twig', [
        'userForm' => $form->createView(),
    ] );
  }
}
