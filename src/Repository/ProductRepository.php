<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

	public function getWithSearchQueryBuilder (?array $filter_data): QueryBuilder
	{
		$qb = $this->createQueryBuilder('p');

		if (isset($filter_data['name']) && !empty($filter_data['name'])){
			$qb->where('p.name LIKE :name')
				->setParameter('name', '%' . $filter_data['name'] . '%');
			;
		}

		return $qb
			->orderBy('p.id', 'DESC')
			;
	}
}
