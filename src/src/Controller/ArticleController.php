<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Article;
use App\Entity\Question;
use App\Entity\Tag;
use App\Entity\User;
use App\Form\ArticleType;
use App\Form\QuestionFormType;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ManagerRegistry;
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


  #[Route( '/articles/{tag}/{idArticle}', name: 'app_articles_by_idArticle' )]
  public function findByIdTagAndByIdArticle( EntityManagerInterface $entityManager, $idArticle, Request $request ) {
    $repository = $entityManager->getRepository( Article::class );
    $article    = $repository->find( $idArticle );

    $repository = $entityManager->getRepository( Question::class );
    $questions  = $repository->findByIdArticleJoinAnswer( $idArticle );

    //$repository = $entityManager->getRepository( Answer::class );
    //$answer  = $repository->findByIdQuestion( $questions );

    $list_question = [];

    $repository = $entityManager->getRepository( Answer::class );
    $answer     = $repository->findByIdQuestion( $questions );


    //dd($questions, $article);
    return $this->render( 'article/single.html.twig', [
        'article'   => $article,
        'questions' => $questions,
    ] );
  }

  #[Route( '/new_article', name: 'app_new_article' )]
  public function new(
      EntityManagerInterface $entityManager,
      Request $request,
      ManagerRegistry $doctrine,
  )
  : Response {
    $repository = $entityManager->getRepository( Tag::class );
    $tags       = $repository->findAll();


    $title       = $request->request->get( 'title' );
    $price       = $request->request->get( 'price' );
    $description = $request->request->get( 'description' );
    $tagNAme     = $request->request->get( 'tagName' );


    //dd($user);


    //dd($tags);

    if ( $title ) {

      $tag = $repository->find( $tagNAme );

      /*    $repositoryUser = $entityManager->getRepository( User::class );
          $user = $repository->find();*/

      $entityManager = $doctrine->getManager();

      $product = new Article();
      $product->setTitle( $title );
      $product->setPrice( $price );
      $product->setSlug( $title );
      $product->setCreatedAt( new \DateTime( $request->get( 'time' ) ) );
      $product->setUpdatedAt( new \DateTime( $request->get( 'time' ) ) );
      $product->setDescription( $description );
      $product->setIdTag( $tag );
      $product->setIdUser( $this->getUser() );

      // tell Doctrine you want to (eventually) save the Product (no queries yet)
      $entityManager->persist( $product );

      // actually executes the queries (i.e. the INSERT query)
      $entityManager->flush();

      $this->addFlash( 'success', 'Artcle Ajouté' );
    }


    return $this->render( 'article/article_new.html.twig', [
        'tags' => $tags,
    ] );
  }


  #[Route( '/articles/{tag}/{id}/vote', methods: 'post' )]
  public function singleVote(
      EntityManagerInterface $entityManager,
      Request $request
  ) {
//Todo checker le repository pour faire le systéme de  like et dislike , ajouter ducoup des conditions ici dans le controller mais aussi dans le controller
    $direction = $request->request->get( 'direction' );


    return $this->json( [
        'test' => $direction,
    ] );
  }
}
