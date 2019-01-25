<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
  /**
   * @Route("/sfff4-admin", name="admin")
   */
  public function index()
  {
    return $this->render('admin/index.html.twig', [
      'controller_name' => 'AdminController',
      'current_menu_item' => 'admin'
    ]);
  }
}
