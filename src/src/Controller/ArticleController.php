<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController {
  #[Route( '/article', name: 'app_article' )]
  public function index()
  : Response {
    return $this->render( 'article/index.html.twig', [
        'controller_name' => 'ArticleController',
    ] );
  }

  #[Route( '/test', name: 'app_artileq' )]
  public function test( EntityManagerInterface $entityManager ) {
    $repository = $entityManager->getRepository( Article::class );
    $articles   = $repository->findAll();


    return $this->render( 'article/index.html.twig', [
        'title'    => 'eeeeeeeeeee',
        'articles' => $articles,
    ] );
  }

  #[Route( '/article/{userId}', name: 'app_articles_by_id' )]
  public function listarticlebyiduser( EntityManagerInterface $entityManager, $userId ) {
    $repository = $entityManager->getRepository( Article::class );
    $articles   = $repository->findByIdUser( $userId );


    return $this->render( 'article/index.html.twig', [
        'title'    => 'eeeeeeeeeee',
        'articles' => $articles,
    ] );
  }

  #[Route( '/new_article', name: 'app_new_article' )]
  public function new(
      EntityManagerInterface $entityManager,
      Request $request
  )
  : Response {

    $form = $this->createForm( ArticleType::class );
    $form->handleRequest( $request );
    if ( $form->isValid() && $form->isSubmitted() ) {
      $newArticle = $form->getData();
      $entityManager->persist( $newArticle );
      $entityManager->flush();

    }

    return $this->render( 'article/article_new.html.twig', [
        'articleForm' => $form->createView(),
    ] );
  }
}
