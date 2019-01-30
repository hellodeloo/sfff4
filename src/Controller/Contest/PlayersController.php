<?php

namespace App\Controller\Contest;

use App\Entity\Players;
use App\Form\PlayersType;
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
   * @Route("/contest", name="contest")
   */
  public function index()
  {
    return $this->render('contest/index.html.twig', [
      'controller_name' => 'Contest Index',
      'current_menu_item' => 'jouer'
    ]);
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
    $form = $this->createForm(PlayersType::class, $player);
    $form->get('current_step')->setData('step01');
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->persist($player);
      $this->em->flush();
      $this->addFlash('success', 'Bien créé avec succès');
    }

    return $this->render('contest/step01.html.twig', [
      'controller_name' => 'Contest Step 01',
      'current_menu_item' => 'jouer',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/contest/v", name="contest.vue")
   */
  public function vue()
  {
    return $this->render('contest/vue.html.twig', [
      'controller_name' => 'Contest Vue.js',
      'current_menu_item' => 'jouer'
    ]);
  }
}
