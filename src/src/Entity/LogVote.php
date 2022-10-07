<?php

namespace App\Entity;

use App\Repository\LogVoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogVoteRepository::class)]
class LogVote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $score = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Vote $idVote = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getIdVote(): ?Vote
    {
        return $this->idVote;
    }

    public function setIdVote(?Vote $idVote): self
    {
        $this->idVote = $idVote;

        return $this;
    }
}
