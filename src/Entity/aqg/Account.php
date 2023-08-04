<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="Account", uniqueConstraints={@ORM\UniqueConstraint(name="UserName", columns={"UserName"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\AccountRepository")
 */
class Account
{
    /**
     * @var string
     *
     * @ORM\Column(name="SteamID", type="string", length=256, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $steamid;

    /**
     * @var string
     *
     * @ORM\Column(name="UserName", type="string", length=128, nullable=false)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Bio", type="string", length=256, nullable=true)
     */
    private $bio;

    /**
     * @var int
     *
     * @ORM\Column(name="QuizPlayed", type="integer", nullable=false)
     */
    private $quizplayed = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Win", type="integer", nullable=false)
     */
    private $win = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Lose", type="integer", nullable=false)
     */
    private $lose = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="QuizCreated", type="integer", nullable=true)
     */
    private $quizcreated = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="MultiplayerQuizPlayed", type="integer", nullable=false)
     */
    private $multiplayerquizplayed = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="YourQuizPlayed", type="integer", nullable=false)
     */
    private $yourquizplayed = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="GlobalQuizMark", type="integer", nullable=true)
     */
    private $globalquizmark;

    /**
     * @var int|null
     *
     * @ORM\Column(name="GlobalRanking", type="integer", nullable=true)
     */
    private $globalranking;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationDate", type="datetime", nullable=false)
     */
    private $creationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ConnectionDate", type="datetime", nullable=false)
     */
    private $connectiondate;

    public function getSteamid(): ?string
    {
        return $this->steamid;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getQuizplayed(): ?int
    {
        return $this->quizplayed;
    }

    public function setQuizplayed(int $quizplayed): self
    {
        $this->quizplayed = $quizplayed;

        return $this;
    }

    public function getWin(): ?int
    {
        return $this->win;
    }

    public function setWin(int $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getLose(): ?int
    {
        return $this->lose;
    }

    public function setLose(int $lose): self
    {
        $this->lose = $lose;

        return $this;
    }

    public function getQuizcreated(): ?int
    {
        return $this->quizcreated;
    }

    public function setQuizcreated(?int $quizcreated): self
    {
        $this->quizcreated = $quizcreated;

        return $this;
    }

    public function getMultiplayerquizplayed(): ?int
    {
        return $this->multiplayerquizplayed;
    }

    public function setMultiplayerquizplayed(int $multiplayerquizplayed): self
    {
        $this->multiplayerquizplayed = $multiplayerquizplayed;

        return $this;
    }

    public function getYourquizplayed(): ?int
    {
        return $this->yourquizplayed;
    }

    public function setYourquizplayed(int $yourquizplayed): self
    {
        $this->yourquizplayed = $yourquizplayed;

        return $this;
    }

    public function getGlobalquizmark(): ?int
    {
        return $this->globalquizmark;
    }

    public function setGlobalquizmark(?int $globalquizmark): self
    {
        $this->globalquizmark = $globalquizmark;

        return $this;
    }

    public function getGlobalranking(): ?int
    {
        return $this->globalranking;
    }

    public function setGlobalranking(?int $globalranking): self
    {
        $this->globalranking = $globalranking;

        return $this;
    }

    public function getCreationdate(): ?\DateTimeInterface
    {
        return $this->creationdate;
    }

    public function setCreationdate(\DateTimeInterface $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getConnectiondate(): ?\DateTimeInterface
    {
        return $this->connectiondate;
    }

    public function setConnectiondate(\DateTimeInterface $connectiondate): self
    {
        $this->connectiondate = $connectiondate;

        return $this;
    }
}
