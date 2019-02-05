<?php

namespace App\Controller\Admin;

use App\Entity\Players;
use App\Repository\PlayersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Writer as Writer;

/**
 * @Route("/admin/players")
 */
class AdminPlayersController extends AbstractController
{

  /**
   * @Route("/export", name="admin.players.export", methods={"GET"})
   * @return Response
   * @param PlayersRepository $playersRepository
   * @throws \PhpOffice\PhpSpreadsheet\Exception
   */
  public function export(PlayersRepository $playersRepository): Response
  {
    $players = $playersRepository->findAll();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $i = 0;
    foreach ($players as $player) {
      $i++;
      $sheet->setCellValue("A{$i}", "{$player->getFirstname()}");
      $sheet->setCellValue("B{$i}", "{$player->getLastname()}");
    }

    $writer = new Writer\Xls($spreadsheet);

    $response =  new StreamedResponse(
      function () use ($writer) {
        $writer->save('php://output');
      }
    );
    $response->headers->set('Content-Type', 'application/vnd.ms-excel');
    $response->headers->set('Content-Disposition', 'attachment;filename="ExportScan.xls"');
    $response->headers->set('Cache-Control','max-age=0');

    return $response;
  }


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
