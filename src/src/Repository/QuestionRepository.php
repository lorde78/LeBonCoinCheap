<?php

namespace App\Repository;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @extends ServiceEntityRepository<Question>
 *
 * @method Question|null find( $id, $lockMode = null, $lockVersion = null )
 * @method Question|null findOneBy( array $criteria, array $orderBy = null )
 * @method Question[]    findAll()
 * @method Question[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class QuestionRepository extends ServiceEntityRepository {
  public function __construct( ManagerRegistry $registry ) {
    parent::__construct( $registry, Question::class );
  }

  public function save( Question $entity, bool $flush = false )
  : void {
    $this->getEntityManager()->persist( $entity );

    if ( $flush ) {
      $this->getEntityManager()->flush();
    }
  }

  public function remove( Question $entity, bool $flush = false )
  : void {
    $this->getEntityManager()->remove( $entity );

    if ( $flush ) {
      $this->getEntityManager()->flush();
    }
  }


  /**
   * @return Question[] Returns an array of Question by idArticle objects
   */
  public function findByIdArticle( $id )
  : array {
    return $this->createQueryBuilder( 'q' )
                ->andWhere( 'q.idArticle = :val' )
                ->setParameter( 'val', $id )
                ->orderBy( 'q.id', 'ASC' )
                ->getQuery()
                ->getResult();
  }

  /**
   * @return Question[] Returns an array of Question by Join objects
   */
  public function findByIdArticleJoinAnswer( $id )
  : array {
    return $this->createQueryBuilder( 'q' )
                ->innerJoin( 'q.answers', 'ans' )
                ->addSelect( 'ans' )
                ->innerJoin( 'q.idUser', 'u' )
                ->addSelect( 'u' )
                ->innerJoin( 'ans.idUser', 'us' )
                ->addSelect( 'us' )
                ->andWhere( 'q.idArticle = :val' )
                ->setParameter( 'val', $id )
                ->orderBy( 'q.id', 'ASC' )
                ->getQuery()
                ->getResult();
  }


//SELECT * FROM `question` INNER JOIN answer ON question.id = answer.id_question_id;
//    /**
//     * @return Question[] Returns an array of Question objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Question
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
