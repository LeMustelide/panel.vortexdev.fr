<?php

namespace App\Entity\aqg;
use App\Entity\aqg\Account;
use App\Entity\aqg\ReportsStatus;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reports
 *
 * @ORM\Table(name="Reports", indexes={@ORM\Index(name="Type", columns={"Type"}), @ORM\Index(name="SteamID", columns={"SteamID"}), @ORM\Index(name="QuizID", columns={"QuizID"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\ReportsRepository")
 */
class Reports
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
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=32, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=256, nullable=false)
     */
    private $description;

    /**
     * @var \ReportsType
     *
     * @ORM\ManyToOne(targetEntity="ReportsType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Type", referencedColumnName="Name")
     * })
     */
    private $type;

    /**
     * @var \ReportsStatus
     *
     * @ORM\ManyToOne(targetEntity="ReportsStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Status", referencedColumnName="Name")
     * })
     */
    private $status;

    /**
     * @var \Quizinformations
     *
     * @ORM\ManyToOne(targetEntity="Quizinformations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="QuizID", referencedColumnName="ID")
     * })
     */
    private $quizid;

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
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=false)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?ReportsType
    {
        return $this->type;
    }

    public function setType(?ReportsType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQuizid(): ?Quizinformations
    {
        return $this->quizid;
    }

    public function setQuizid(?Quizinformations $quizid): self
    {
        $this->quizid = $quizid;

        return $this;
    }

    public function getStatus(): ?string //?ReportsStatus
    {
        return $this->status->getName();
    }

    public function setStatus(?ReportsStatus $status): self
    {
        $this->status = $status;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
