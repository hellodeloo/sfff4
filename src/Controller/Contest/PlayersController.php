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
  private $em;

  public function __construct(PlayersRepository $repository, ObjectManager $em)
  {
    $this->repository = $repository;
    $this->em = $em;
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
    $form = $this->createForm(StepsType::class);
    $form->get('current_step')->setData('step01');
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->persist($player);
      $this->em->flush();
      $this->addFlash('success', 'Bien créé avec succès');
      return $this->redirectToRoute('contest.step02');
    }

    return $this->render('contest/step01.html.twig', [
      'controller_name' => 'Contest Step 01',
      'current_menu_item' => 'contest',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }

  /*UPDATE A PARTIR PLAYER ICI*/
  /**
   * @Route("/contest/s02", name="contest.step02")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */

  public function step02(Request $request)
  {
    $player = new Players();
    $form = $this->createForm(StepsType::class);
    $form->get('current_step')->setData('step02');
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->persist($player);
      $this->em->flush();
      $this->addFlash('success', 'Bien upadaté avec succès');
    }

    return $this->render('contest/step02.html.twig', [
      'controller_name' => 'Contest Step 02',
      'current_menu_item' => 'contest',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/contest/s04", name="contest.step04")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */


/*  public function step04(Request $request)
  {
    $player = new Players();
    $form = $this->createForm(PlayersType::class, $player);
    $form->get('current_step')->setData('step04');
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->persist($player);
      $this->em->flush();
      $this->addFlash('success', 'Bien créé avec succès');
    }

    return $this->render('contest/step04.html.twig', [
      'controller_name' => 'Contest Step 04',
      'current_menu_item' => 'contest',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }*/

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
