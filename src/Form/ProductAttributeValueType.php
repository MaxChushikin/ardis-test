<?php

namespace App\Form;

use App\Entity\Attribute;
use App\Entity\AttributeValue;
use App\Repository\AttributeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductAttributeValueType extends AbstractType
{
	private $attributeRepository;

	public function __construct (AttributeRepository $attributeRepository)
	{
		$this->attributeRepository = $attributeRepository;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attribute', EntityType::class, [
            	'class'			=> Attribute::class,
				'choice_label' => function(Attribute $attribute) {
					return $attribute->getName();
				}
			])
			->add('name', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AttributeValue::class,
        ]);
    }

	private function getAttributeSelect ()
	{
		$choices = [];

		foreach($this->attributeRepository->findAll() as $choice){
			$choices[$choice->getName()] = $choice->getId();
		}

		return $choices;
	}
}
