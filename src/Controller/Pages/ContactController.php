<?php

namespace App\Controller\Pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
  /**
   * @Route("/contact", name="contact")
   */
  public function index()
  {
    return $this->render('pages/contact.html.twig', [
      'controller_name' => 'ContactController',
      'current_menu_item' => 'contact'
    ]);
  }
}
