<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
	 * @Route("/admin/product", name="admin_product")
	 */

	/**
	 * @Route("/admin/product/{slug<\d+>}", name="admin_product_show")
	 */
	public function show ()
	{

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
