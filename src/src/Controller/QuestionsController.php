<?php

namespace App\Controller;

use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsController extends AbstractController {

  #[Route( '/questions', name: 'app_questions' )]
  public function index()
  : Response {

    return $this->render( 'questions/index.html.twig', [
        'controller_name' => 'QuestionsController',
    ] );
  }

  #[Route( '/question/{IdArticle}', name: 'app_question_by_id' )]
  public function listarticlebyidarticle( EntityManagerInterface $entityManager, $IdArticle ) {
    $repository = $entityManager->getRepository( Question::class );
    $questions  = $repository->findByIdArticle( $IdArticle );
    dd( $questions );


    return $this->render( 'question/index.html.twig', [
        'title'     => 'eeeeeeeeeee',
        'questions' => $questions,
    ] );
  }
}
