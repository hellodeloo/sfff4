<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayersRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("email")
 */
class Players
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
   * @Assert\Length(min=2, max=100)
   */
  private $firstname;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
   * @Assert\Length(min=2, max=100)
   */
  private $lastname;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
   * @Assert\Email()
   */
  private $email;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $address;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @Assert\Regex("/^[0-9]{5}$/")
   */
  private $postal_code;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
   * @Assert\Length(min=2, max=100)
   */
  private $city;

  /**
   * @ORM\Column(type="datetime")
   */
  private $created_at;

  /**
   * @ORM\Column(type="datetime")
   */
  private $updated_at;

  /**
   * @ORM\OneToMany(targetEntity="App\Entity\Answers", mappedBy="player", orphanRemoval=true)
   */
  private $answers;

  /**
   * Players constructor.
   * @throws \Exception
   */
  public function __construct()
  {
    $this->created_at = new \DateTime();
    $this->updated_at = new \DateTime();
    $this->answers = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getFirstname(): ?string
  {
    return $this->firstname;
  }

  public function setFirstname(?string $firstname): self
  {
    $this->firstname = $firstname;

    return $this;
  }

  public function getLastname(): ?string
  {
    return $this->lastname;
  }

  public function setLastname(?string $lastname): self
  {
    $this->lastname = $lastname;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(?string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getAddress(): ?string
  {
    return $this->address;
  }

  public function setAddress(?string $address): self
  {
    $this->address = $address;

    return $this;
  }

  public function getPostalCode(): ?string
  {
    return $this->postal_code;
  }

  public function setPostalCode(?string $postal_code): self
  {
    $this->postal_code = $postal_code;

    return $this;
  }

  public function getCity(): ?string
  {
    return $this->city;
  }

  public function setCity(?string $city): self
  {
    $this->city = $city;

    return $this;
  }

  public function getCurrentStep(): ?string
  {
    return $this->current_step;
  }

  public function setCurrentStep(string $current_step): self
  {
    $this->current_step = $current_step;

    return $this;
  }

   public function getCreatedAt(): ?\DateTimeInterface
  {
    return $this->created_at;
  }

  public function setCreatedAt(\DateTimeInterface $created_at): self
  {
    $this->created_at = $created_at;

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeInterface
  {
    return $this->updated_at;
  }

  public function setUpdatedAt(\DateTimeInterface $updated_at): self
  {
    $this->updated_at = $updated_at;

    return $this;
  }

  /**
   * @throws \Exception
   * @ORM\PreUpdate
   */
  public function setUpdatedAtValue()
  {
    $this->updated_at = new \DateTime();
  }

  /**
   * @return Collection|Answers[]
   */
  public function getAnswers(): Collection
  {
      return $this->answers;
  }

  public function addAnswer(Answers $answer): self
  {
      if (!$this->answers->contains($answer)) {
          $this->answers[] = $answer;
          $answer->setPlayer($this);
      }

      return $this;
  }

  public function removeAnswer(Answers $answer): self
  {
      if ($this->answers->contains($answer)) {
          $this->answers->removeElement($answer);
          // set the owning side to null (unless already changed)
          if ($answer->getPlayer() === $this) {
              $answer->setPlayer(null);
          }
      }

      return $this;
  }
}
