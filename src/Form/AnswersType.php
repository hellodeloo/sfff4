<?php

namespace App\Form;

use App\Entity\Answers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswersType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('question')
      ->add('answer')
      ->add('priority', ChoiceType::class, [
        'choices' => $this->getChoices()
      ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Answers::class,
      'translation_domain' => 'forms'
    ]);
  }

  private function getChoices()
  {
    $choices = Answers::PRIORITY;
    $output = [];
    foreach($choices as $k => $v) {
      $output[$v] = $v;
    }
    return $output;
  }
}
