<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Form\ExamType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   */
  public function index()
  {
      return $this->render('home/index.html.twig', [
          'controller_name' => 'HomeController',
      ]);
  }

}
