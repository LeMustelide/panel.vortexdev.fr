<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quiznote
 *
 * @ORM\Table(name="QuizNote", indexes={@ORM\Index(name="QuizNote_ibfk_2", columns={"SteamID"}), @ORM\Index(name="QuizNote_ibfk_1", columns={"QuizID"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\QuiznoteRepository")
 */
class Quiznote
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
     * @ORM\Column(name="Note", type="integer", nullable=false)
     */
    private $note;

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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

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
