<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnswersController extends AbstractController {
  #[Route( '/answers', name: 'app_answers' )]
  public function index()
  : Response {
    return $this->render( 'answers/index.html.twig', [
        'controller_name' => 'AnswersController',
    ] );
  }

  #[Route( '/answer/{IdQuestion}', name: 'app_answer_by_id' )]
  public function listarticlebyidquestion( EntityManagerInterface $entityManager, $IdQuestion ) {
    $repository = $entityManager->getRepository( Answer::class );
    $answers  = $repository->findByIdQuestion( $IdQuestion );
    dd( $answers );


    return $this->render( 'answer/index.html.twig', [
        'title'     => 'eeeeeeeeeee',
        'answers' => $answers,
    ] );
  }


  #[Route( '/answers/{id}/vote', methods: 'post' )]
  public function singleVote(
      Answer $answer,
      EntityManagerInterface $entityManager,
      Request $request
  ) {
//Todo checker le repository pour faire le systéme de  like et dislike , ajouter ducoup des conditions ici dans le controller mais aussi dans le controller
    $direction = $request->request->get( 'direction' );

    if($direction === 'up') {
      $answer->upVote();
    }
    else {
      $answer->downVote();
    }

    $entityManager->flush();

    return $this->json( [
        'votes' => $answer->getLogVote(),
    ] );
  }
}
