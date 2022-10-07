<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $booleanVote = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $idUser = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Article $idArticle = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function isBooleanVote(): ?bool
    {
        return $this->booleanVote;
    }

    public function setBooleanVote(bool $booleanVote): self
    {
        $this->booleanVote = $booleanVote;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

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
