<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\UserAnswer;
use App\Repository\QuestionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAnswerType extends AbstractType
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
            'class' => Question::class,
        ])
        ->add('answer')
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
        'data_class' => UserAnswer::class,
    ]);
  }
}
