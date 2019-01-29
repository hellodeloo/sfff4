<?php

namespace App\Controller\Pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   * @return Response
   */
  public function index(): Response
  {
    return $this->render('pages/home.html.twig', [
      'controller_name' => 'HomeController',
      'current_menu_item' => 'home'
    ]);
  }
}