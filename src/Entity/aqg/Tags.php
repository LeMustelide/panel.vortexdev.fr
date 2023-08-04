<?php

namespace App\Entity\aqg;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tags
 *
 * @ORM\Table(name="Tags")
 * @ORM\Entity(repositoryClass="App\Repository\aqg\TagsRepository")
 */
class Tags
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
     * @ORM\Column(name="Name", type="string", length=24, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Publicquiz", mappedBy="tagid")
     */
    private $quizid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quizid = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * @return Collection|Publicquiz[]
     */
    public function getQuizid(): Collection
    {
        return $this->quizid;
    }

    public function addQuizid(Publicquiz $quizid): self
    {
        if (!$this->quizid->contains($quizid)) {
            $this->quizid[] = $quizid;
            $quizid->addTagid($this);
        }

        return $this;
    }

    public function removeQuizid(Publicquiz $quizid): self
    {
        if ($this->quizid->removeElement($quizid)) {
            $quizid->removeTagid($this);
        }

        return $this;
    }

}
