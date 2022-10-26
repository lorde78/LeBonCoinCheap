<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagsController extends AbstractController {
  #[Route( '/tags', name: 'app_tags' )]
  public function index()
  : Response {
    return $this->render( 'tags/index.html.twig', [
        'controller_name' => 'TagsController',
    ] );
  }

  #[Route( '/', name: 'app_tags_all' )]
  public function getAllTags(
      EntityManagerInterface $entityManager
  )
  : Response {
    $repository = $entityManager->getRepository( Tag::class );
    $tags       = $repository->findAll();

    return $this->render( 'test/test.html.twig', [
        'tags' => 'testtttt',
    ] );
  }

  #[Route( '/{tags}', name: 'app_articles_by_tag' )]
  public function getArticlesByTags( $tags,
      EntityManagerInterface $entityManager
  )
  : Response {
    $repository = $entityManager->getRepository( Tag::class );
    $tag        = $repository->findTagByName($tags);

    $repositoryArticle = $entityManager->getRepository(Article::class);
    $articles = $repositoryArticle->findByIdTag($tag);


    //dd($articles);



    return $this->render( 'tags/archive_tags.html.twig', [
        'articles' => $articles,
      'tagName' => $tags,
    ] );
  }
}
