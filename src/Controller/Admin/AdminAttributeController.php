<?php

	namespace App\Controller\Admin;

	use App\Entity\Attribute;
	use App\Entity\Product;
	use App\Form\AttributeFormType;
	use App\Repository\AttributeRepository;
	use Doctrine\ORM\EntityManagerInterface;
	use Knp\Component\Pager\PaginatorInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AdminAttributeController extends AbstractController
	{
		/**
		 * @Route("/admin/attribute",  name="admin_attribute_list")
		 * @param AttributeRepository $repository
		 * @return Response
		 */
		public function list (AttributeRepository $repository, Request $request, PaginatorInterface $paginator)
		{
			$data = [];
			$filter_data = [];

			$filter_data['search'] = $request->query->get('search');

			$queryBuilder = $repository->getWithSearchQueryBuilder($filter_data);

			$pagination = $paginator->paginate(
				$queryBuilder,
				$request->query->getInt('page', 1),
				10
			);

			$data['pagination'] = $pagination;

			return $this->render('admin/attribute/list.html.twig', $data);
		}

		/**
		 * @Route("/admin/attribute/add", name="admin_attribute_add")
		 */
		public function add (EntityManagerInterface $em, Request $request)
		{
			$data = [];

			$form = $this->createForm(AttributeFormType::class);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$product = $form->getData();

				$em->persist($product);
				$em->flush();

				$this->addFlash("success", 'Attribute created!');

				return $this->redirectToRoute('admin_attribute_list');
			}

			$data['attributeForm'] = $form->createView();

			$data['text_title'] = 'Add attribute';

			return $this->render('admin/attribute/form.html.twig', $data);
		}

		/**
		 * @Route("/admin/attribute/edit/{id<\d+>}", name="admin_attribute_edit")
		 */
		public function edit (Attribute $attribute, EntityManagerInterface $em, Request $request)
		{
			$data = [];

			$form = $this->createForm(AttributeFormType::class, $attribute);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$product = $form->getData();

				$em->persist($product);
				$em->flush();

				$this->addFlash("success", 'Attribute updated!');

				return $this->redirectToRoute('admin_attribute_list');
			}

			$data['attributeForm'] = $form->createView();

			$data['text_title'] = 'Edit attribute';

			return $this->render('admin/attribute/form.html.twig', $data);
		}

		/**
		 * @Route("/admin/attribute/remove/{id<\d+>}", name="admin_attribute_remove")
		 */
		public function remove (Attribute $attribute)
		{
			if ($attribute) {
				$name = $attribute->getName();

				if ($count = $attribute->getAttributeValues()->count()) {
					$this->addFlash("error", "You can`t remove \"{$name}\". Attribute belongs to {$count} products");
				} else {
					$em = $this->getDoctrine()->getManager();
					$em->remove($attribute);
					$em->flush();

					$this->addFlash("success", "Attribute \"{$name}\" deleted!");
				}

				return $this->redirectToRoute('admin_attribute_list');
			}
		}
	}
