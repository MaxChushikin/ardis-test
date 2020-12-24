<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AttributeValueFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

	protected function loadData (ObjectManager $manager)
	{
		// TODO: Implement loadData() method.
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
