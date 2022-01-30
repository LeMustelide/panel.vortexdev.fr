<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scoreboard
 *
 * @ORM\Table(name="Scoreboard", indexes={@ORM\Index(name="SteamID_2", columns={"SteamID"}), @ORM\Index(name="SteamID", columns={"SteamID"}), @ORM\Index(name="QuizID", columns={"QuizID"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\ScoreboardRepository")
 */
class Scoreboard
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="Score", type="integer", nullable=false)
     */
    private $score;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \Account
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SteamID", referencedColumnName="SteamID")
     * })
     */
    private $steamid;

    /**
     * @var \Publicquiz
     *
     * @ORM\ManyToOne(targetEntity="Publicquiz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="QuizID", referencedColumnName="QuizID")
     * })
     */
    private $quizid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSteamid(): ?Account
    {
        return $this->steamid;
    }

    public function setSteamid(?Account $steamid): self
    {
        $this->steamid = $steamid;

        return $this;
    }

    public function getQuizid(): ?Publicquiz
    {
        return $this->quizid;
    }

    public function setQuizid(?Publicquiz $quizid): self
    {
        $this->quizid = $quizid;

        return $this;
    }


}
