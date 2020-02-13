<?php

namespace App\Controller;

use App\Form\ExamType;
use App\Repository\ExamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   * @param ExamRepository $examRepository
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function index(ExamRepository $examRepository)
  {
    $exams = $examRepository->findAll();

    return $this->render('home/index.html.twig', [
      'controller_name' => 'HomeController',
      'exams' => $exams
    ]);
  }

}
