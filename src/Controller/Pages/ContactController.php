<?php

namespace App\Controller\Pages;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {
  /**
   * @param Request $request
   * @param ContactNotification $contactNotification
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   * @Route("/contact", name="contact")
   */
  public function index(Request $request, ContactNotification $contactNotification)
  {
    $contact = new Contact();
    $form = $this->createForm(ContactType::class, $contact);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $contactNotification->notify($contact);
      $this->addFlash('success', 'Votre email a été envoyé!');
      return $this->redirectToRoute('home');
    }

    return $this->render('pages/contact.html.twig', [
      'controller_name' => 'ContactController',
      'current_menu_item' => 'contact',
      'form' => $form->createView()
    ]);
  }
}
