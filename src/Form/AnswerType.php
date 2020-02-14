<?php

namespace App\Form;

use App\Entity\AnswerOption;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerType extends AbstractType
{
  protected $questionRepository;

  public function __construct(QuestionRepository $questionRepository)
  {
    $this->questionRepository = $questionRepository;
  }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('question', EntityType::class, [
              'class' => Question::class
          ])
          ->add('answer')
          ->add('is_right')
          ->add('save', SubmitType::class)
      ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AnswerOption::class,
        ]);
    }
}
