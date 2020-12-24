<?php

	namespace App\Controller\Admin;

	use App\Repository\AttributeRepository;
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
		 * @Route("/admin/attribute/edit/{id<\d+>}", name="admin_attribute_edit")
		 */
		public function edit ()
		{

		}

		/**
		 * @Route("/admin/attribute/remove/{id<\d+>}", name="admin_attribute_remove")
		 */
		public function remove ()
		{

		}
	}
