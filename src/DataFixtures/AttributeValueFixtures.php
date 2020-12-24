<?php

namespace App\DataFixtures;

use App\Entity\AttributeValue;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AttributeValueFixtures extends BaseFixtures implements DependentFixtureInterface
{
	protected function loadData (ObjectManager $manager)
	{

		$product_references = $this->getAllReferences('products');
		$attribute_references = $this->getAllReferences('attributes');

		if ($attribute_references && $product_references){

			$count = count($attribute_references) * count($product_references);

			$this->createMany($count, 'attributeValues', function($i) use ($attribute_references, $product_references) {

				$attributeValue = new AttributeValue();
				$attributeValue->setName($this->faker->word);

				$product_i = $i % count($product_references);
				$attributeValue->setProduct($product_references[$product_i]);

				$attribute_i = $i % count($attribute_references);
				$attributeValue->setAttribute($attribute_references[$attribute_i]);

				return $attributeValue;
			});
		}

		$manager->flush();
	}

	/**
	 * @inheritDoc
	 */
	public function getDependencies ()
	{
		return [
			ProductFixtures::class,
			AttributeFixtures::class
		];
	}
}
