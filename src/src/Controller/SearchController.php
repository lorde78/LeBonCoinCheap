<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Question;
use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController {
  #[Route( '/search', name: 'app_search' )]
  public function index()
  : Response {
    return $this->render( 'search/index.html.twig', [
        'controller_name' => 'SearchController',
    ] );
  }

  // public function searchNav() {
  //   $form = $this->createFormBuilder()
  //               ->setAction( $this->generateUrl( 'handleSearch' ) )
  //               ->add( 'query', TextType::class, [
  //                  'label' => false,
  //                  'attr'  => [
  //                      'class'       => 'form-control',
  //                      'placeholder' => 'Rechercher',
  //                   ],
  //              ] )
  //              ->add( 'Recherche', SubmitType:: class, [
  //                'attr' => [
  //                     'class' => 'btn btn-secondary',
  //                 ],
  //            ] )
  //            ->getForm();

//return $this->render( 'search/searchNAv.html.twig', ['searchForm' => $form->createView(),] );
//}


  /**
   * @Route("/handleSearch", name="app_handle_search")
   */
  public
  function handleSearch(
      Request $request,
      ArticleRepository $articleRepository

  ) {

    $search   = $request->query->get( 'q' );
    $articles = $articleRepository->findArticlesByName( $search );


    // dd($articles);
    return $this->render( 'article/result_search_article.html.twig',
        [
            "articles" => $articles,
        ]
    );

  }
}
