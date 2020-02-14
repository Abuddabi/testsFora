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
    $submittedToken = $request->request->get('token');

    if($this->isCsrfTokenValid('submit', $submittedToken)){

      $result = $request->request->all();
      array_pop($result); //удаляет последний элемент с токеном. Иначе ошибка
      $questionRepository = $this->getDoctrine()->getRepository(Question::class);
      $em = $this->getDoctrine()->getManager();

      foreach ($result as $questionId => $answer){
        $question = $questionRepository->find($questionId);
        $userAnswer = new UserAnswer();
        $userAnswer->setQuestion($question);
        $userAnswer->setAnswer($answer);

        $em->persist($userAnswer);
        $em->flush();
      }

      return $this->redirectToRoute('showResult', [
          'exam' => $exam
      ]);
    }

    return $this->render('passExam/index.html.twig', [
      'controller_name' => 'PassExamController',
      'exam' => $exam
    ]);
  }

  /**
   * @Route("/show/result/{exam}", name="showResult")
   * @param Exam $exam
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function showResult(Exam $exam)
  {

    return $this->render('passExam/showResult.html.twig', [
        'exam' => exam
    ]);
  }
}
