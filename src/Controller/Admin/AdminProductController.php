<?php

namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    /**
     * @Route("/admin/product", name="admin_product")
     */
    public function index(): Response
    {
        return $this->render('admin_product/index.html.twig', [
            'controller_name' => 'AdminProductController',
        ]);
    }

	/**
	 * @Route("/admin/product/{slug<\d+>}", name="admin_product_show")
	 */
	public function show ()
	{

	}

	/**
	 * @Route("/admin/product",  name="admin_product")
	 * @param ProductRepository $repository
	 * @return Response
	 */
	public function list (ProductRepository $repository, Request $request, PaginatorInterface $paginator)
	{
		$data = [];
		$filter_data = [];

		$filter_data['search'] = $request->query->get('search');

		$queryBuilder = $repository->getWithSearchQueryBuilder($filter_data);

		$pagination = $paginator->paginate(
			$queryBuilder, /* query NOT result */
			$request->query->getInt('page', 1),
			2 /* Limit */
		);

		$data['pagination'] = $pagination;

		return $this->render('admin/product/list.html.twig', $data);
	}

	/**
	 * @Route("/admin/product/add/{slug}", name="admin_product_add")
	 */
	public function add ()
	{

    }

	/**
	 * @Route("/admin/product/edit/{slug}", name="admin_product_edit")
	 */
	public function edit ()
	{

    }

	/**
	 * @Route("/admin/product/edit/{slug}", name="admin_product_edit")
	 */
	public function remove ()
	{

	}

}
