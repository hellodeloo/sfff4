<?php

namespace App\Controller\Contest;

use App\Entity\Players;
use App\Form\PlayersType;
use App\Form\StepsType;
use App\Repository\PlayersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlayersController extends AbstractController
{
  /**
   * @var PlayersRepository
   */
  private $repository;
  /**
   * @var ObjectManager
   */
  private $om;

  public function __construct(PlayersRepository $repository, ObjectManager $om)
  {
    $this->repository = $repository;
    $this->om = $om;
  }

  /**
   * @Route("/contest/s01", name="contest.step01")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */

  public function step01(Request $request)
  {
    $player = new Players();
    $form = $this->createForm(StepsType::class, $player);
    $form->get('current_step')->setData('step01');
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->om->persist($player);
      $this->om->flush();
      $this->addFlash('success', 'Bien créé avec succès');
      return $this->redirectToRoute('contest.step02', [
        'id' => $player->getId()
      ]);
    }

    return $this->render('contest/step01.html.twig', [
      'controller_name' => 'Contest Step 01',
      'current_menu_item' => 'contest',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/contest/s02/{id}", name="contest.step02", methods="GET|POST")
   * @param Request $request
   * @param Players $player
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */
  public function step02(Request $request, Players $player)
  {
    $form = $this->createForm(StepsType::class, $player);
    $form->get('current_step')->setData('step02');
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid() && $this->isCsrfTokenValid('edit' . $player->getId(), $request->get('_token'))) {
      $this->om->flush();
      $this->addFlash('success', 'Bien updaté avec succès');
      return $this->redirectToRoute('contest.step03', [
        'id' => $player->getId()
      ]);
    }

    return $this->render('contest/step02.html.twig', [
      'controller_name' => 'Contest Step 02',
      'current_menu_item' => 'contest',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/contest/s03/{id}", name="contest.step03", methods="GET|POST")
   * @param Request $request
   * @param Players $player
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */
  public function step03(Request $request, Players $player)
  {
    $form = $this->createForm(StepsType::class, $player);
    $form->get('current_step')->setData('step03');
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid() && $this->isCsrfTokenValid('edit' . $player->getId(), $request->get('_token'))) {
      $this->om->flush();
      $this->addFlash('success', 'Bien updaté avec succès');
      return $this->redirectToRoute('contest.step04', [
        'id' => $player->getId()
      ]);
    }

    return $this->render('contest/step03.html.twig', [
      'controller_name' => 'Contest Step 03',
      'current_menu_item' => 'contest',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }


  /**
   * @Route("/contest/s04/{id}", name="contest.step04", methods="GET|POST")
   * @param Request $request
   * @param Players $player
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */
  public function step04(Request $request, Players $player)
  {
    $form = $this->createForm(PlayersType::class, $player);
    $form->get('current_step')->setData('step04');
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid() && $this->isCsrfTokenValid('edit' . $player->getId(), $request->get('_token'))) {
      $this->om->flush();
      $this->addFlash('success', 'Bien updaté avec succès');
      return $this->redirectToRoute('home');
    }

    return $this->render('contest/step04.html.twig', [
      'controller_name' => 'Contest Step 04',
      'current_menu_item' => 'contest',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }


  /**
   * @Route("/contest/v", name="contest.stepVue")
   */
  public function vue()
  {
    return $this->render('contest/stepVue.html.twig', [
      'controller_name' => 'Contest Vue.js',
      'current_menu_item' => 'contest'
    ]);
  }
}
