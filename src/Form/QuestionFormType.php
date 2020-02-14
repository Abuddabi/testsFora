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
        $builder
            ->add('exam', EntityType::class, [
              'class' => Exam::class
            ])
            ->add('type', EntityType::class, [
                'class' => QuestionType::class
            ])
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
