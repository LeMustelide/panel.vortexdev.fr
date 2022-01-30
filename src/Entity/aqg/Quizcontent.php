<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quizcontent
 *
 * @ORM\Table(name="QuizContent", indexes={@ORM\Index(name="Type_2", columns={"Type"}), @ORM\Index(name="Type", columns={"Categorie"}), @ORM\Index(name="IDQuiz", columns={"QuizID"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\QuizcontentRepository")
 */
class Quizcontent
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
     * @ORM\Column(name="Question", type="string", length=512, nullable=false)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="Answer_1", type="string", length=256, nullable=false)
     */
    private $answer1;

    /**
     * @var string
     *
     * @ORM\Column(name="Answer_2", type="string", length=256, nullable=false)
     */
    private $answer2;

    /**
     * @var string
     *
     * @ORM\Column(name="Answer_3", type="string", length=256, nullable=false)
     */
    private $answer3;

    /**
     * @var string
     *
     * @ORM\Column(name="Answer_4", type="string", length=256, nullable=false)
     */
    private $answer4;

    /**
     * @var string
     *
     * @ORM\Column(name="Hint", type="string", length=64, nullable=false)
     */
    private $hint;

    /**
     * @var string
     *
     * @ORM\Column(name="Explanation", type="string", length=512, nullable=false)
     */
    private $explanation;

    /**
     * @var int
     *
     * @ORM\Column(name="Tolerance", type="integer", nullable=false)
     */
    private $tolerance;

    /**
     * @var int
     *
     * @ORM\Column(name="Difficulty", type="integer", nullable=false)
     */
    private $difficulty;

    /**
     * @var int
     *
     * @ORM\Column(name="Timer", type="integer", nullable=false)
     */
    private $timer;

    /**
     * @var int
     *
     * @ORM\Column(name="NumberCorrectAnswer", type="integer", nullable=false, options={"default"="1"})
     */
    private $numbercorrectanswer = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="RequiredCorrectAnswer", type="integer", nullable=false, options={"default"="1"})
     */
    private $requiredcorrectanswer = 1;

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
     * @var \Answercategories
     *
     * @ORM\ManyToOne(targetEntity="Answercategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Categorie", referencedColumnName="ID")
     * })
     */
    private $categorie;

    /**
     * @var \Answertype
     *
     * @ORM\ManyToOne(targetEntity="Answertype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Type", referencedColumnName="ID")
     * })
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer1(): ?string
    {
        return $this->answer1;
    }

    public function setAnswer1(string $answer1): self
    {
        $this->answer1 = $answer1;

        return $this;
    }

    public function getAnswer2(): ?string
    {
        return $this->answer2;
    }

    public function setAnswer2(string $answer2): self
    {
        $this->answer2 = $answer2;

        return $this;
    }

    public function getAnswer3(): ?string
    {
        return $this->answer3;
    }

    public function setAnswer3(string $answer3): self
    {
        $this->answer3 = $answer3;

        return $this;
    }

    public function getAnswer4(): ?string
    {
        return $this->answer4;
    }

    public function setAnswer4(string $answer4): self
    {
        $this->answer4 = $answer4;

        return $this;
    }

    public function getHint(): ?string
    {
        return $this->hint;
    }

    public function setHint(string $hint): self
    {
        $this->hint = $hint;

        return $this;
    }

    public function getExplanation(): ?string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): self
    {
        $this->explanation = $explanation;

        return $this;
    }

    public function getTolerance(): ?int
    {
        return $this->tolerance;
    }

    public function setTolerance(int $tolerance): self
    {
        $this->tolerance = $tolerance;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getTimer(): ?int
    {
        return $this->timer;
    }

    public function setTimer(int $timer): self
    {
        $this->timer = $timer;

        return $this;
    }

    public function getNumbercorrectanswer(): ?int
    {
        return $this->numbercorrectanswer;
    }

    public function setNumbercorrectanswer(int $numbercorrectanswer): self
    {
        $this->numbercorrectanswer = $numbercorrectanswer;

        return $this;
    }

    public function getRequiredcorrectanswer(): ?int
    {
        return $this->requiredcorrectanswer;
    }

    public function setRequiredcorrectanswer(int $requiredcorrectanswer): self
    {
        $this->requiredcorrectanswer = $requiredcorrectanswer;

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

    public function getCategorie(): ?Answercategories
    {
        return $this->categorie;
    }

    public function setCategorie(?Answercategories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getType(): ?Answertype
    {
        return $this->type;
    }

    public function setType(?Answertype $type): self
    {
        $this->type = $type;

        return $this;
    }


}
