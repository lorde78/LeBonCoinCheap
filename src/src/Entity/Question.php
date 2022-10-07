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
  private ?string $title = null;

  #[ORM\Column( length: 255 )]
  private ?string $content = null;

  #[ORM\ManyToOne( inversedBy: 'questions' )]
  private ?User $idUser = null;

  #[ORM\OneToMany( mappedBy: 'idQuestion', targetEntity: Answer::class )]
  private Collection $answers;

  #[ORM\ManyToOne(inversedBy: 'questions')]
  private ?Article $idArticle = null;

  public function __construct() {
    $this->answers = new ArrayCollection();
  }

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

  public function getContent()
  : ?string {
    return $this->content;
  }

  public function setContent( string $content )
  : self {
    $this->content = $content;

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

  public function getIdArticle(): ?Article
  {
      return $this->idArticle;
  }

  public function setIdArticle(?Article $idArticle): self
  {
      $this->idArticle = $idArticle;

      return $this;
  }
}
