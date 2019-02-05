<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswersRepository")
 */
class Answers
{

  const PRIORITY = [
    0 => 'Basse',
    1 => 'Moyenne',
    2 => 'Haute'
  ];


  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $question;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $answer;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $priority;

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Players", inversedBy="answers")
   * @ORM\JoinColumn(nullable=false)
   */
  private $player;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getQuestion(): ?string
  {
    return $this->question;
  }

  public function setQuestion(string $question): self
  {
    $this->question = $question;

    return $this;
  }

  public function getAnswer(): ?string
  {
    return $this->answer;
  }

  public function setAnswer(string $answer): self
  {
    $this->answer = $answer;

    return $this;
  }

  public function getPriority(): ?string
  {
    return $this->priority;
  }

  public function setPriority(string $priority): self
  {
    $this->priority = $priority;

    return $this;
  }

  public function getPriorityType(): string
  {
    return self::PRIORITY[$this->priority];
  }

  public function getPlayer(): ?Players
  {
      return $this->player;
  }

  public function setPlayer(?Players $player): self
  {
      $this->player = $player;

      return $this;
  }
}
