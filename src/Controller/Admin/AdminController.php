<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
  /**
   * @Route("/admin", name="admin.index")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function index()
  {
    return $this->render('admin/index.html.twig', [
      'controller_name' => 'AdminController',
      'current_menu_item' => 'admin'
    ]);
  }
}
