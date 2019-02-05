<?php

namespace App\Controller\Admin;

use App\Entity\Answers;
use App\Entity\Players;
use App\Repository\PlayersRepository;
use App\Repository\AnswersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/players")
 */
class AdminPlayersController extends AbstractController
{
  /**
   * @Route("/", name="admin.players.index", methods={"GET"})
   * @param PlayersRepository $playersRepository
   * @return Response
   */
  public function index(PlayersRepository $playersRepository): Response
  {
    return $this->render('admin/players/index.html.twig', [
      'controller_name' => 'Admin Players Index',
      'players' => $playersRepository->findAll(),
    ]);
  }


  /**
   * @Route("/{id}", name="admin.players.show", methods={"GET"})
   * @param Players $player
   * @return Response
   */
  public function show(Players $player): Response
  {
    return $this->render('admin/players/show.html.twig', [
      'controller_name' => 'Admin Players Show',
      'player' => $player
    ]);
  }

  /**
   * @Route("/{id}", name="admin.players.delete", methods={"DELETE"})
   * @param Request $request
   * @param Players $player
   * @return Response
   */
  public function delete(Request $request, Players $player): Response
  {
    if ($this->isCsrfTokenValid('delete'.$player->getId(), $request->request->get('_token'))) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($player);
      $entityManager->flush();
    }

    return $this->redirectToRoute('admin.players.index');
  }
}
