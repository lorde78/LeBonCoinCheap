<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
  use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'idArticle', targetEntity: Question::class)]
    private Collection $questions;



    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?User $idUser = null;

    #[ORM\Column(length: 255)]
    private  $title = null;

    #[ORM\Column(length: 255)]
    private  $slug = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private  $description = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $pictures = [];

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Tag $idTag = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setIdArticle($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getIdArticle() === $this) {
                $question->setIdArticle(null);
            }
        }

        return $this;
    }


    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser( $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle( $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice( $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription( $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function setPictures(array $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getIdTag(): ?Tag
    {
        return $this->idTag;
    }

    public function setIdTag( $idTag): self
    {
        $this->idTag = $idTag;

        return $this;
    }

  /**
   * @return string|null
   */
  public function getSlug()
  : ?string {
    return $this->slug;
  }


  public function setSlug($slug): self
  {
    $this->slug = str_replace( ['-','?'], '',$this->slug);
    $this->slug = str_replace( [ "\""  ,' ',',','!',';','\'','.'], '-',$this->getTitle());
    return $this;
  }
}
