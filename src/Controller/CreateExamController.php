<?php

namespace App\Controller;

use App\Entity\AnswerOption;
use App\Entity\Exam;
use App\Entity\Question;
use App\Entity\QuestionType;
use App\Form\AnswerType;
use App\Form\ExamType;
use App\Form\QuestionFormType;
use App\Form\TypeOfQuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateExamController extends AbstractController
{
  /**
   * @Route("/create/exam", name="createExam")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function createExam(Request $request)
  {
    $exam = new Exam();

    $form = $this->createForm(ExamType::class, $exam, [
        'action' => $this->generateUrl('createExam')
    ]);

//    var_dump($request->getContent()); die;
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

      $em = $this->getDoctrine()->getManager();

      $em->persist($exam);
      $em->flush();

      return $this->redirectToRoute('createQuestion');
    }

    return $this->render('create/createExam.html.twig', [
        'controller_name' => 'CreateExamController',
        'createExam' =>$form->createView()
    ]);
  }

  /**
   * @Route("/create/questionType", name="createQuestionType")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function createQuestionType(Request $request)
  {
    $questionType = new QuestionType();

    $form = $this->createForm(TypeOfQuestionType::class, $questionType, [
        'action' => $this->generateUrl('createQuestionType')
    ]);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

      $em = $this->getDoctrine()->getManager();

      $em->persist($questionType);
      $em->flush();

      return $this->redirectToRoute('createQuestion');
    }

    return $this->render('create/createQuestionType.html.twig', [
        'controller_name' => 'CreateExamController',
        'createQuestionType' => $form->createView()
    ]);
  }

  /**
   * @Route("/create/question", name="createQuestion")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function createQuestion(Request $request)
  {
    $question = new Question();

    $form = $this->createForm(QuestionFormType::class, $question, [
        'action' => $this->generateUrl('createQuestion')
    ]);
//    var_dump($request->getContent('exam')); die;

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($question);

      $em->flush();

      return $this->redirectToRoute('createAnswer');
    }

    return $this->render('create/createQuestion.html.twig', [
        'controller_name' => 'CreateExamController',
        'createQuestion' =>$form->createView()
    ]);
  }

  /**
   * @Route("/create/answer", name="createAnswer")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function createAnswer(Request $request)
  {
    $answer = new AnswerOption();

    $form = $this->createForm(AnswerType::class, $answer, [
        'action' => $this->generateUrl('createAnswer')
    ]);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

      $em = $this->getDoctrine()->getManager();

      $em->persist($answer);
      $em->flush();

      return $this->redirectToRoute('createExam');
    }

    return $this->render('create/createAnswer.html.twig', [
        'controller_name' => 'CreateExamController',
        'createAnswer' =>$form->createView()
    ]);
  }
}
