<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity( repositoryClass: AnswerRepository::class )]
class Answer {
  use TimestampableEntity;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column( length: 255 )]
  private ?string $answer = null;


  #[ORM\ManyToOne( inversedBy: 'answers' )]
  private ?User $idUser = null;

  #[ORM\ManyToOne( inversedBy: 'answers' )]
  private ?Question $idQuestion = null;

  public function getId()
  : ?int {
    return $this->id;
  }

  public function getTitle()
  : ?string {
    return $this->title;
  }

  public function setTitle( string $title )
  : self {
    $this->title = $title;

    return $this;
  }

  public function getAnswer()
  : ?string {
    return $this->answer;
  }

  public function setAnswer( string $answer )
  : self {
    $this->answer = $answer;

    return $this;
  }

  public function getIdUser()
  : ?User {
    return $this->idUser;
  }

  public function setIdUser( ?User $idUser )
  : self {
    $this->idUser = $idUser;

    return $this;
  }

  public function getIdQuestion()
  : ?Question {
    return $this->idQuestion;
  }

  public function setIdQuestion( ?Question $idQuestion )
  : self {
    $this->idQuestion = $idQuestion;

    return $this;
  }
}
