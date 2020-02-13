<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\Question;
use App\Entity\UserAnswer;
use App\Form\UserAnswerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PassExamController extends AbstractController
{
  /**
   * @Route("/pass/exam/{exam}", name="passExam")
   * @param Exam $exam
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function index(Exam $exam, Request $request)
    {
      $userAnswer = new UserAnswer;
      $examId = $exam->getId();
      $questions = $this->getDoctrine()->getRepository(Question::class)->findBy([
          'exam' => 1
      ]);
      var_dump($questions[0]); die;
      $form = $this->createForm(UserAnswerType::class, $userAnswer, [
          'action' => "/pass/exam/$examId"
      ]);

      return $this->render('passExam/index.html.twig', [
        'controller_name' => 'PassExamController',
        'exam' => $exam,
        'passExam' => $form->createView()
      ]);
    }
}
