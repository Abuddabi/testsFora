<?php

namespace App\Form;

use App\Entity\Exam;
use App\Entity\Question;
use App\Entity\QuestionType;
use App\Repository\ExamRepository;
use App\Repository\QuestionTypeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionFormType extends AbstractType
{
  protected $examRepository;
  protected $typeRepository;

  public function __construct(ExamRepository $examRepository, QuestionTypeRepository $typeRepository)
  {
    $this->examRepository = $examRepository;
    $this->typeRepository = $typeRepository;
  }

  public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Получаем данные для options(выборки) в форме
        // Получаем все Названия тестов
        $exams = $this->examRepository->findAll();
        foreach ($exams as $exam){
          // Юзер будет видеть Название теста
          $examTitle[] = $exam->getTitle();

          // а передаваться через форму будет id теста
          $examId[] = $exam->getId();
        }
        $examChoices = array_combine($examTitle, $examId);

        // Получаем типы вопросов
        $types = $this->typeRepository->findAll();
        foreach ($types as $type){
          // Юзер будет видеть Название типа
          $typeName[] = $type->getTypeName();

          // а передаваться через форму будет id типа
          $typeId[] = $type->getId();
        }
        $typeChoices = array_combine($typeName, $typeId);

        $builder
            ->add('exam', EntityType::class, [
              'class' => Exam::class
            ], array('choices' => $examChoices))
            ->add('type', EntityType::class, [
                'class' => QuestionType::class
            ], array('choices' => $typeChoices))
            ->add('text')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
