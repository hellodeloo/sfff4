<?php

namespace App\Controller\Contest;

use App\Entity\Answers;
use App\Entity\Players;
use App\Form\AnswersType;
use App\Form\PlayersType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contest")
 */
class ContestController extends AbstractController
{
  /**
   * @var SessionInterface
   */
  private $session;

  /**
   * @var ObjectManager
   */
  private $om;

  public function __construct(ObjectManager $om, SessionInterface $session)
  {
    $this->session = $session;
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
      $this->session->start();
      $this->session->set('answers', []);

      $sessionAnswers = $this->session->get('answers');
      array_push(
        $sessionAnswers, [
          'question' => $answer->getQuestion(),
          'answer' => $answer->getAnswer(),
          'priority' => $answer->getPriority()
        ]
      );
      $this->session->set('answers', $sessionAnswers);

      $this->addFlash('success', 'Bien ajouté avec succès');
      return $this->redirectToRoute('contest.step01');
    }

    $this->session->clear();

    return $this->render('contest/stepAnswer.html.twig', [
      'controller_name' => 'Contest Step 00',
      'current_menu_item' => 'contest',
      'answer' => $answer,
      'session' => $this->session->all(),
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/s01", name="contest.step01")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function step01(Request $request)
  {
    $answer = new Answers();
    $form = $this->createForm(AnswersType::class, $answer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $sessionAnswers = $this->session->get('answers');
      array_push(
        $sessionAnswers, [
          'question' => $answer->getQuestion(),
          'answer' => $answer->getAnswer(),
          'priority' => $answer->getPriority()
        ]
      );
      $this->session->set('answers', $sessionAnswers);

      $this->addFlash('success', 'Bien updaté avec succès');
      return $this->redirectToRoute('contest.step02');
    }

    return $this->render('contest/stepAnswer.html.twig', [
      'controller_name' => 'Contest Step 01',
      'current_menu_item' => 'contest',
      'answer' => $answer,
      'session' => $this->session->all(),
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/s02", name="contest.step02")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function step02(Request $request)
  {
    $answer = new Answers();
    $form = $this->createForm(AnswersType::class, $answer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $sessionAnswers = $this->session->get('answers');
      array_push(
        $sessionAnswers, [
          'question' => $answer->getQuestion(),
          'answer' => $answer->getAnswer(),
          'priority' => $answer->getPriority()
        ]
      );
      $this->session->set('answers', $sessionAnswers);

      $this->addFlash('success', 'Bien updaté avec succès');
      return $this->redirectToRoute('contest.step03');
    }

    return $this->render('contest/stepAnswer.html.twig', [
      'controller_name' => 'Contest Step 02',
      'current_menu_item' => 'contest',
      'answer' => $answer,
      'session' => $this->session->all(),
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/s03", name="contest.step03", methods="GET|POST")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */
  public function step03(Request $request)
  {
    $player = new Players();
    $form = $this->createForm(PlayersType::class, $player);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid() && $this->isCsrfTokenValid('insert' . $player->getId(), $request->get('_token'))) {
      $this->om->persist($player);

      $sessionAnswers = $this->session->get('answers');

      foreach ($sessionAnswers as $sessionAnswer) {
        $answer = new Answers();
        $answer->setQuestion($sessionAnswer['question']);
        $answer->setAnswer($sessionAnswer['answer']);
        $answer->setPriority($sessionAnswer['priority']);
        $answer->setPlayer($player);
        $this->om->persist($answer);
      }

      $this->om->flush();
      $this->addFlash('success', 'Bien ajouté avec succès');
      return $this->redirectToRoute('home');
    }

    return $this->render('contest/stepPlayer.html.twig', [
      'controller_name' => 'Contest Step 03',
      'current_menu_item' => 'contest',
      'player' => $player,
      'session' => $this->session->all(),
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
