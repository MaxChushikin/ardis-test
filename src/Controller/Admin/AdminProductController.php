<?php

	namespace App\Controller\Admin;

	use App\Entity\Product;
	use App\Form\ProductFormType;
	use App\Repository\ProductRepository;
	use Doctrine\ORM\EntityManagerInterface;
	use Knp\Component\Pager\PaginatorInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AdminProductController extends AbstractController
	{
		/**
		 * @Route("/admin/product",  name="admin_product_list")
		 * @param ProductRepository $repository
		 * @return Response
		 */
		public function list (ProductRepository $repository, Request $request, PaginatorInterface $paginator)
		{
			$data = [];

			$filter_data['name'] = $request->query->get('name');

			$queryBuilder = $repository->getWithSearchQueryBuilder($filter_data);

			$products = $paginator->paginate(
				$queryBuilder,
				$request->query->getInt('page', 1),
				$request->query->get('limit',10),
				[
					'defaultSortFieldName'      => 'p.id',
					'defaultSortDirection' 		=> 'desc'
				]
			);

			$data['products'] = $products;

			return $this->render('admin/product/list.html.twig', $data);
		}


		/**
		 * @Route("/admin/product/{id<\d+>}", name="admin_product_show")
		 */

		public function show ()
		{

		}

		/**
		 * @Route("/admin/product/add", name="admin_product_add")
		 */
		public function add (EntityManagerInterface $em, Request $request)
		{
			$data = [];

			$form = $this->createForm(ProductFormType::class);
			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()){
				/** @var Product $product */
				$product = $form->getData();

				$em->persist($product);
				$em->flush();

				$this->addFlash("success", 'Product created!');

				return $this->redirectToRoute('admin_product_list');
			}

			$data['productForm'] = $form->createView();

			$data['text_title'] = 'Add product';

			return $this->render('admin/product/form.html.twig', $data);
		}

		/**
		 * @Route("/admin/product/edit/{id<\d+>}", name="admin_product_edit")
		 */
		public function edit (Product $product, EntityManagerInterface $em, Request $request)
		{
			$data = [];

			$form = $this->createForm(ProductFormType::class, $product);
			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()){
				/** @var Product $product */
				$product = $form->getData();

				$em->persist($product);
				$em->flush();

				$this->addFlash("success", 'Product Updates!');

				return $this->redirectToRoute('admin_product_list');
			}

			$data['productForm'] = $form->createView();

			$data['text_title'] = 'Edit product';

			return $this->render('admin/product/form.html.twig', $data);
		}

		/**
		 * @Route("/admin/product/remove/{id<\d+>}", name="admin_product_remove")
		 */
		public function remove (Product $product)
		{
			if ($product) {
				$name = $product->getName();

				$em = $this->getDoctrine()->getManager();
				$em->remove($product);
				$em->flush();

				$this->addFlash("success", "Attribute \"{$name}\" deleted!");

				$this->addFlash("success", 'Product deleted!');

				return $this->redirectToRoute('admin_product_list');
			}
		}
	}
