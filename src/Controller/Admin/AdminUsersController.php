<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class AdminUsersController extends AbstractController
{
  /**
   * @Route("/login", name="admin.users.login")
   * @param AuthenticationUtils $authenticationUtils
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function login (AuthenticationUtils $authenticationUtils) {
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();
    return $this->render('admin/login.html.twig', [
      'controller_name' => 'AdminUsersController',
      'current_menu_item' => 'admin',
      'last_username' => $lastUsername,
      'error' => $error
    ]);
  }
}
