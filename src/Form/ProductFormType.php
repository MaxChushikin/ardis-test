<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
            	'label' 	=> "Type product name",
				'required' 		=> TRUE,
			])
            ->add('price', MoneyType::class, [
				'label' 	=> "Type product price",
				'divisor' 		=> 100,
				'required' 		=> TRUE,
			])
			->add('attributeValue', CollectionType::class, [
				'entry_type'	=> ProductAttributeValueType::class,
				'allow_add' 	=> true,
				'allow_delete' 	=> true,
				'prototype' 	=> true,
			])
		;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
