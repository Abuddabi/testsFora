<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\Question;
use App\Entity\QuestionType;
use App\Form\ExamType;
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
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

      $em = $this->getDoctrine()->getManager();

      $em->persist($exam);
      $em->flush();

      return $this->redirectToRoute('createQuestion');
    }

    return $this->render('home/createExam.html.twig', [
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

//    $form = $this->createForm(QuestionType::class, $question, [
//        'action' => $this->generateUrl('createQuestion')
//    ]);
//    $form->handleRequest($request);
//
//    if($form->isSubmitted() && $form->isValid()){
//
//      $em = $this->getDoctrine()->getManager();
//
//      $em->persist($question);
//      $em->flush();
//
//      return $this->redirectToRoute('createQuestionType');
//    }

    return $this->render('home/createQuestion.html.twig', [
        'controller_name' => 'CreateExamController',
//        'createQuestion' =>$form->createView()
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

//    $form = $this->createForm(QuestionType::class, $question, [
//        'action' => $this->generateUrl('createQuestion')
//    ]);
//    $form->handleRequest($request);
//
//    if($form->isSubmitted() && $form->isValid()){
//
//      $em = $this->getDoctrine()->getManager();
//
//      $em->persist($question);
//      $em->flush();
//
//      return $this->redirectToRoute('createQuestionType');
//    }

    return $this->render('home/createQuestion.html.twig', [
        'controller_name' => 'CreateExamController',
//        'createQuestion' =>$form->createView()
    ]);
  }
}
