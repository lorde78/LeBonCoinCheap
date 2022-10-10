<?php

namespace App\Controller;

use App\Entity\Article;
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

  #[Route( '/articles/new', name: 'app_article_new' )]
  public function new()
  : Response {
    return $this->render( 'article/article_new.html.twig' );
  }

  #[Route( '/articles/new_api', name: 'app_article_new_api' )]
  public function newApi( Request $request): Response
   {
    $dd = "d";
    dd($request);
  }
}
