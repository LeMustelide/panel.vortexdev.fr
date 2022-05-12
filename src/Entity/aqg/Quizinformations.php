<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quizinformations
 *
 * @ORM\Table(name="QuizInformations", indexes={@ORM\Index(name="QuizInformations_ibfk_1", columns={"SteamID"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\QuizinformationsRepository")
 */
class Quizinformations
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=256, nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="Difficulty", type="float", precision=10, scale=0, nullable=false)
     */
    private $difficulty;

    /**
     * @var int
     *
     * @ORM\Column(name="Lifes", type="integer", nullable=false)
     */
    private $lifes;

    /**
     * @var bool
     *
     * @ORM\Column(name="Skip", type="boolean", nullable=false)
     */
    private $skip;

    /**
     * @var bool
     *
     * @ORM\Column(name="SpecificOrder", type="boolean", nullable=false)
     */
    private $specificorder = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UpdateDate", type="datetime", nullable=false)
     */
    private $updatedate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationDate", type="datetime", nullable=false)
     */
    private $creationdate;

    /**
     * @var \Account
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SteamID", referencedColumnName="SteamID")
     * })
     */
    private $steamid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getDifficulty(): ?float
    {
        return $this->difficulty;
    }

    public function setDifficulty(float $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getLifes(): ?int
    {
        return $this->lifes;
    }

    public function setLifes(int $lifes): self
    {
        $this->lifes = $lifes;

        return $this;
    }

    public function getSkip(): ?bool
    {
        return $this->skip;
    }

    public function setSkip(bool $skip): self
    {
        $this->skip = $skip;

        return $this;
    }

    public function getSpecificorder(): ?bool
    {
        return $this->specificorder;
    }

    public function setSpecificorder(bool $specificorder): self
    {
        $this->specificorder = $specificorder;

        return $this;
    }

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setUpdatedate(\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

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
