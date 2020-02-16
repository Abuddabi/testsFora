<?php

namespace App\Controller;

use App\Entity\AnswerOption;
use App\Entity\Exam;
use App\Entity\Question;
use App\Entity\UserAnswer;
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

      $userAnswers = $request->request->all();
      array_pop($userAnswers); //удаляет последний элемент с токеном. Иначе ошибка
      $questionRepository = $this->getDoctrine()->getRepository(Question::class);
      $em = $this->getDoctrine()->getManager();
//      dump($result); die;

      foreach ($userAnswers as $questionId => $answer){
        //checkboxes return array where key is question id and value is array of answers
        if(is_array($answer)){
          foreach ($answer as $key => $sub_answer){
            $question = $questionRepository->find($questionId);
            $userAnswer = new UserAnswer();
            $userAnswer->setQuestion($question);
            $userAnswer->setAnswer($sub_answer);

            $em->persist($userAnswer);
            $em->flush();
          }

          continue;
        }

        $question = $questionRepository->find($questionId);
        $userAnswer = new UserAnswer();
        $userAnswer->setQuestion($question);
        $userAnswer->setAnswer($answer);

        $em->persist($userAnswer);
        $em->flush();
      }

      $examId = $exam->getId();
      return $this->redirect("/show/result/$examId");
    }

    $checkboxes = [];
    return $this->render('passExam/index.html.twig', [
      'controller_name' => 'PassExamController',
      'exam' => $exam,
      'checkboxes' => $checkboxes
    ]);
  }


  /**
   * @Route("/show/result/{exam}", name="showResult")
   * @param Exam $exam
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function showResult(Exam $exam)
  {
    $userAnswers = [];
    foreach ($exam->getQuestions() as $question){
      $questionId = $question->getId();

      foreach($question->getUserAnswer() as $userAnswer){

        //if question is a checkbox
        if($question->getType()->getId() == 2){
          $userAnswers["$questionId"][] = $userAnswer->getAnswer();

          continue;
        }

        $userAnswers["$questionId"] = $userAnswer->getAnswer();
      }
    }

    return $this->render('passExam/showResult.html.twig', [
      'exam' => $exam,
      'userAnswers' => $userAnswers
    ]);
  }
}
