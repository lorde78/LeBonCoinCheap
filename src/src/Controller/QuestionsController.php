<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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



  public function new(): Response
  {
    $form =$this->createForm(QuestionFormType::class);
    return $this->render('question/new.html.twig', [
        'questionForm' =>$form->createView()
    ]);
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


  #[Route( '/questions/{id}/vote', methods: 'post' )]
  public function singleVote(
      Question $question,
      EntityManagerInterface $entityManager,
      Request $request
  ) {
//Todo checker le repository pour faire le systéme de  like et dislike , ajouter ducoup des conditions ici dans le controller mais aussi dans le controller
    $direction = $request->request->get( 'direction' );

    if($direction === 'up') {
      $question->upVote();
    }
    else {
      $question->downVote();
    }

    $entityManager->flush();

    return $this->json( [
        'votes' => $question->getLogVote(),
    ] );
  }



}
