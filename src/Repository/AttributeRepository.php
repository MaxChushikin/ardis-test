<?php

namespace App\Repository;

use App\Entity\Attribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attribute[]    findAll()
 * @method Attribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attribute::class);
    }

	public function getWithSearchQueryBuilder (?array $filter_data): QueryBuilder
	{
		$qb = $this->createQueryBuilder('a');

		if (isset($filter_data['search']) && !empty($filter_data['search'])){
			$qb->andWhere('a.name LIKE :search')
				->setParameter('search', '%' . $filter_data['search'] . '%');
			;
		}

		return $qb
			->orderBy('a.id', 'DESC')
			;
	}
}
