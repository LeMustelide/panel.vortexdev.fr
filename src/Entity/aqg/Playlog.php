<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlog
 *
 * @ORM\Table(name="PlayLog", indexes={@ORM\Index(name="QuizID", columns={"QuizID"}), @ORM\Index(name="IDX_3BD9BF34DDAF226E", columns={"SteamID"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\PlaylogRepository")
 */
class Playlog
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $date;

    /**
     * @var \Publicquiz
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Publicquiz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="QuizID", referencedColumnName="QuizID")
     * })
     */
    private $quizid;

    /**
     * @var \Account
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SteamID", referencedColumnName="SteamID")
     * })
     */
    private $steamid;

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
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

    public function getSteamid(): ?Account
    {
        return $this->steamid;
    }

    public function setSteamid(?Account $steamid): self
    {
        $this->steamid = $steamid;

        return $this;
    }


}
