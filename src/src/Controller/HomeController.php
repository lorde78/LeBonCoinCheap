<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Tag;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

  public $security;

  #[Route( '/', name: 'app_home' )]
  public function index(
      EntityManagerInterface $entityManager,
      Security $security
  )
  : Response {
    $repositoryTag = $entityManager->getRepository( Tag::class );
    $tags          = $repositoryTag->findAll();

    $repositoryArticle = $entityManager->getRepository( Article::class );
    $articles          = $repositoryArticle->findByTotalQuestion();


    //dd($user);
    return $this->render( 'home/index.html.twig', [
        'controller_name' => 'HomeController',
        'tags'            => $tags,
        'articles'        => $articles,
    ] );
  }

}
