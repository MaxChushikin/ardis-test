<?php

namespace App\DataFixtures;

use App\Entity\Attribute;
use Doctrine\Persistence\ObjectManager;

class AttributeFixtures extends BaseFixtures
{
	private $attributeNames = [
		'Square',
		'Color',
	];

	protected function loadData (ObjectManager $manager)
	{
		$this->createMany(count($this->attributeNames), 'attribute', function($i){

			$attribute = new Attribute();

			$attribute->setName($this->attributeNames[$i]);
			$attribute->setSortOrder($this->faker->numberBetween(0, 10));

			return $attribute;
		});

		$manager->flush();
	}
}
