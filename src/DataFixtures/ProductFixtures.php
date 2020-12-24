<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends BaseFixtures
{
	protected function loadData (ObjectManager $manager)
	{
		$this->createMany(50, 'products', function($i){

			$product = new Product();

			$product->setName($this->faker->company);
			$product->setPrice($this->faker->randomFloat(2, 200, 5000));
			$product->setCreatedAt($this->faker->dateTimeBetween('-100 days, -10 days'));
			$product->setUpdatedAt($this->faker->dateTimeBetween('-10 days, -1 days'));

			return $product;
		});

		$manager->flush();
	}
}
