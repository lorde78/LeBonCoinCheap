<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use mysql_xdevapi\Collection;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find( $id, $lockMode = null, $lockVersion = null )
 * @method Article|null findOneBy( array $criteria, array $orderBy = null )
 * @method Article[]    findAll()
 * @method Article[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class ArticleRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Article::class);
	}

	//private static function createApprovedCriteria() : Collection {

	// return $this->article->filter(function(Article $article) {
	//  return $article->isApproved();
	//});
	//}

	public function save(Article $entity, bool $flush = false): void
	{
		$this->getEntityManager()->persist($entity);

		if ($flush) {
			$this->getEntityManager()->flush();
		}
	}

	public function remove(Article $entity, bool $flush = false): void
	{
		$this->getEntityManager()->remove($entity);

		if ($flush) {
			$this->getEntityManager()->flush();
		}
	}

	/**
	 * @return Article[] Returns an array of Article by idUser objects
	 */
	public function findByIdUser($id): array
	{
		return $this->createQueryBuilder('a')
			->andWhere('a.idUser = :val')
			->setParameter('val', $id)
			->orderBy('a.id', 'ASC')
			->setMaxResults(10)
			->getQuery()
			->getResult();
	}


	/**
	 * @return Article[] Returns an array of Article by idTag objects
	 */
	public function findByIdTag($id): array
	{
		return $this->createQueryBuilder('a')
			->andWhere('a.idTag = :val')
			->setParameter('val', $id)
			->orderBy('a.id', 'ASC')
			->setMaxResults(10)
			->getQuery()
			->getResult();
	}

	/**
	 * @return Article[] Returns an array of Article by idTag objects
	 */
	public function findByIdTagAndByIdArticle($idArticle): array
	{
		return $this->createQueryBuilder('a')
			->andWhere('a.id = :valIdArticle')
			->setParameter('valIdArticle', $idArticle)
			->orderBy('a.id', 'ASC')
			->setMaxResults(10)
			->getQuery()
			->getResult();
	}

	/**
	 * @return Article[] Returns an array of Article by name objects
	 */
	public function findArticlesByName(string $search = null, int $max = 12): array
	{
		$queryBuilder = $this->createQueryBuilder('article')
			//->addCriteria( self::createApprovedCriteria() )
			->innerJoin('article.idUser', 'user')
			->addSelect('user');


		if ($search !== null) {
			$queryBuilder
				->innerJoin('article.idTag', 'tag')
				->addSelect('tag')
				->orWhere('tag.name LIKE :searchTerm')
				->orWhere('article.title LIKE :searchTerm')
				->orWhere('article.description LIKE :searchTerm')
				->setParameter('searchTerm', '%' . $search . '%');
		}





		return $queryBuilder


			->setMaxResults($max)
			->getQuery()
			->getResult();
	}



	///    /**
	//     * @return Article[] Returns an array of Article objects
	//     */
	//    public function findByExampleField($value): array
	//    {
	//        return $this->createQueryBuilder('a')
	//            ->andWhere('a.exampleField = :val')
	//            ->setParameter('val', $value)
	//            ->orderBy('a.id', 'ASC')
	//            ->setMaxResults(10)
	//            ->getQuery()
	//            ->getResult()
	//        ;
	//    }

	//    public function findOneBySomeField($value): ?Article
	//    {
	//        return $this->createQueryBuilder('a')
	//            ->andWhere('a.exampleField = :val')
	//            ->setParameter('val', $value)
	//            ->getQuery()
	//            ->getOneOrNullResult()
	//        ;
	//    }
}
