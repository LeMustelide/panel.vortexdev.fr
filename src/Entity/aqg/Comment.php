<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="Comment", indexes={@ORM\Index(name="SteamID", columns={"SteamID"}), @ORM\Index(name="QuizID", columns={"QuizID"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="Comment", type="string", length=512, nullable=false)
     */
    private $comment;

    /**
     * @var int
     *
     * @ORM\Column(name="NumberLike", type="integer", nullable=false)
     */
    private $numberlike;

    /**
     * @var int
     *
     * @ORM\Column(name="NumberDislike", type="integer", nullable=false)
     */
    private $numberdislike;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getNumberlike(): ?int
    {
        return $this->numberlike;
    }

    public function setNumberlike(int $numberlike): self
    {
        $this->numberlike = $numberlike;

        return $this;
    }

    public function getNumberdislike(): ?int
    {
        return $this->numberdislike;
    }

    public function setNumberdislike(int $numberdislike): self
    {
        $this->numberdislike = $numberdislike;

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
