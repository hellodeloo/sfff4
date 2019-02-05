<?php

namespace App\Controller\Contest;

use App\Entity\Answers;
use App\Entity\Players;
use App\Form\AnswersType;
use App\Form\PlayersType;
use App\Repository\PlayersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contest")
 */
class ContestController extends AbstractController
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
   * @Route("/", name="contest.step00")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function step00(Request $request)
  {
    $answer = new Answers();
    $form = $this->createForm(AnswersType::class, $answer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->om->persist($answer);
      $this->om->flush();
      $this->addFlash('success', 'Bien ajouté avec succès');
      return $this->redirectToRoute('home');
    }

    return $this->render('contest/stepAnswer.html.twig', [
      'controller_name' => 'Contest Step 01',
      'current_menu_item' => 'contest',
      'answer' => $answer,
      'form' => $form->createView()
    ]);
  }



  /**
   * @Route("/s04", name="contest.step04", methods="GET|POST")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */
  public function step04(Request $request)
  {
    $player = new Players();
    $form = $this->createForm(PlayersType::class, $player);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid() && $this->isCsrfTokenValid('insert' . $player->getId(), $request->get('_token'))) {
      $this->om->persist($player);
      $this->om->flush();
      $this->addFlash('success', 'Bien ajouté avec succès');
      return $this->redirectToRoute('home');
    }

    return $this->render('contest/stepPlayer.html.twig', [
      'controller_name' => 'Contest Step 04',
      'current_menu_item' => 'contest',
      'player' => $player,
      'form' => $form->createView()
    ]);
  }


  /**
   * @Route("/v", name="contest.stepVue")
   */
  public function vue()
  {
    return $this->render('contest/stepVue.html.twig', [
      'controller_name' => 'Contest Vue.js',
      'current_menu_item' => 'contest'
    ]);
  }
}
