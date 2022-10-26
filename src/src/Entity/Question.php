<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity( repositoryClass: QuestionRepository::class )]
class Question {
  use TimestampableEntity;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column( length: 255 )]
  private ?string $question = null;


  #[ORM\ManyToOne( inversedBy: 'questions' )]
  private ?User $idUser = null;

  #[ORM\OneToMany( mappedBy: 'idQuestion', targetEntity: Answer::class, fetch: 'EAGER' )]
  private Collection $answers;

  #[ORM\ManyToOne( inversedBy: 'questions' )]
  private ?Article $idArticle = null;

  #[ORM\Column]
  private ?int $logVote = 0;


  public function __construct() {
    $this->answers = new ArrayCollection();
  }

  public function getId()
  : ?int {
    return $this->id;
  }


  public function getQuestion()
  : ?string {
    return $this->question;
  }

  public function setQuestion( string $question )
  : self {
    $this->question = $question;

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

  /**
   * @return Collection<int, Answer>
   */
  public function getAnswers()
  : Collection {
    return $this->answers;
  }

  public function addAnswer( Answer $answer )
  : self {
    if ( !$this->answers->contains( $answer ) ) {
      $this->answers->add( $answer );
      $answer->setIdQuestion( $this );
    }

    return $this;
  }

  public function removeAnswer( Answer $answer )
  : self {
    if ( $this->answers->removeElement( $answer ) ) {
      // set the owning side to null (unless already changed)
      if ( $answer->getIdQuestion() === $this ) {
        $answer->setIdQuestion( null );
      }
    }

    return $this;
  }

  public function getIdArticle()
  : ?Article {
    return $this->idArticle;
  }

  public function setIdArticle( ?Article $idArticle )
  : self {
    $this->idArticle = $idArticle;

    return $this;
  }

  public function getLogVote()
  : ?int {
    return $this->logVote;
  }

  public function setLogVote( int $logVote )
  : self {
    $this->logVote = $logVote;

    return $this;
  }

  public function upVote() {
    $this->setLogVote( $this->getLogVote() + 1);
  }

  public function downVote() {
    if ( $this->getLogVote() > 0 ) {
      $this->setLogVote($this->getLogVote() - 1);
    }
    $this->logVote = 0;
    $this->setLogVote($this->logVote);
  }
}
