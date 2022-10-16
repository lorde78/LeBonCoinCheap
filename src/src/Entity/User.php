<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity( repositoryClass: UserRepository::class )]
class User implements UserInterface, PasswordAuthenticatedUserInterface {
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column( length: 255 )]
  private ?string $name = null;

  #[ORM\Column( length: 255 )]
  private ?string $email = null;

  #[ORM\Column( length: 255 )]
  private ?string $nickName = null;

  #[ORM\Column( length: 255 )]
  private ?string $surName = null;

  #[ORM\Column( length: 255 )]
  private ?string $avatar = null;

  #[ORM\Column( length: 255 )]
  private ?string $password = null;

  #[ORM\Column( type: "json" )]
  private $roles = [];


  #[ORM\OneToMany( mappedBy: 'idUser', targetEntity: Question::class )]
  private Collection $questions;

  #[ORM\OneToMany( mappedBy: 'idUser', targetEntity: Answer::class )]
  private Collection $answers;

  #[ORM\OneToMany( mappedBy: 'idUser', targetEntity: Vote::class )]
  private Collection $votes;

  #[ORM\OneToMany( mappedBy: 'idUser', targetEntity: Article::class )]
  private Collection $articles;


  public function __construct( ) {


    $this->questions = new ArrayCollection();
    $this->answers   = new ArrayCollection();
    $this->votes     = new ArrayCollection();
    $this->articles  = new ArrayCollection();
  }


  public function getId()
  : ?int {
    return $this->id;
  }

  /**
   * @see PasswordAuthenticatedUserInterface
   */
  public function getPassword()
  : string {
    return $this->password;
  }

  public function setPassword( string $password )
  : self {
    $this->password = $password;

    return $this;
  }

  /**
   * @see UserInterface
   */

  public function getRoles()
  : array {
    $roles   = $this->roles;
    $roles[] = 'ROLE_USER';

    return array_unique( $roles );
  }

  public function setRoles( array $roles )
  : self {
    $this->roles = $roles;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function getSalt()
  : ?string {
    return null;
  }

  /**
   * @see UserInterface
   */

  public function eraseCredentials()
  {

  }

  public function getUsername(): string
  {
    return  (string) $this->surName;
  }

  public function getName()
  : ?string {
    return $this->name;
  }

  public function setName( string $name )
  : self {
    $this->name = $name;

    return $this;
  }

  public function getEmail()
  : ?string {
    return $this->email;
  }

  public function setEmail( string $email )
  : self {
    $this->email = $email;

    return $this;
  }

  public function getNickName()
  : ?string {
    return $this->nickName;
  }

  public function setNickName( string $nickName )
  : self {
    $this->nickName = $nickName;

    return $this;
  }

  public function getSurName()
  : ?string {
    return $this->surName;
  }

  public function setSurName( string $surName )
  : self {
    $this->surName = $surName;

    return $this;
  }

  public function getAvatar()
  : ?string {
    return $this->avatar;
  }

  public function setAvatar( string $avatar )
  : self {
    $this->avatar = $avatar;

    return $this;
  }

  /**
   * @return Collection<int, Article>
   */
  public function getArticles()
  : Collection {
    return $this->articles;
  }

  public function addArticle( Article $article )
  : self {
    if ( !$this->articles->contains( $article ) ) {
      $this->articles->add( $article );
      $article->setIdUser( $this );
    }

    return $this;
  }

  public function removeArticle( Article $article )
  : self {
    if ( $this->articles->removeElement( $article ) ) {
      // set the owning side to null (unless already changed)
      if ( $article->getIdUser() === $this ) {
        $article->setIdUser( null );
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, Question>
   */
  public function getQuestions()
  : Collection {
    return $this->questions;
  }

  public function addQuestion( Question $question )
  : self {
    if ( !$this->questions->contains( $question ) ) {
      $this->questions->add( $question );
      $question->setIdUser( $this );
    }

    return $this;
  }

  public function removeQuestion( Question $question )
  : self {
    if ( $this->questions->removeElement( $question ) ) {
      // set the owning side to null (unless already changed)
      if ( $question->getIdUser() === $this ) {
        $question->setIdUser( null );
      }
    }

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
      $answer->setIdUser( $this );
    }

    return $this;
  }

  public function removeAnswer( Answer $answer )
  : self {
    if ( $this->answers->removeElement( $answer ) ) {
      // set the owning side to null (unless already changed)
      if ( $answer->getIdUser() === $this ) {
        $answer->setIdUser( null );
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, Vote>
   */
  public function getVotes()
  : Collection {
    return $this->votes;
  }

  public function addVote( Vote $vote )
  : self {
    if ( !$this->votes->contains( $vote ) ) {
      $this->votes->add( $vote );
      $vote->setIdUser( $this );
    }

    return $this;
  }

  public function removeVote( Vote $vote )
  : self {
    if ( $this->votes->removeElement( $vote ) ) {
      // set the owning side to null (unless already changed)
      if ( $vote->getIdUser() === $this ) {
        $vote->setIdUser( null );
      }
    }

    return $this;
  }




  public function getUserIdentifier()
  : string {
    // TODO: Implement getUserIdentifier() method.
  }
}
