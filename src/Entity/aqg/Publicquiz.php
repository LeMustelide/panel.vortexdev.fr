<?php

namespace App\Entity\aqg;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Publicquiz
 *
 * @ORM\Table(name="PublicQuiz")
 * @ORM\Entity(repositoryClass="App\Repository\aqg\PublicquizRepository")
 */
class Publicquiz
{
    /**
     * @var string
     *
     * @ORM\Column(name="UniversalID", type="string", length=32, nullable=false)
     */
    private $universalid;

    /**
     * @var float
     *
     * @ORM\Column(name="Rating", type="float", precision=10, scale=0, nullable=false)
     */
    private $rating = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="RatingNumber", type="integer", nullable=false)
     */
    private $ratingnumber = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="PlayNumber", type="integer", nullable=false)
     */
    private $playnumber = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="Explicit", type="boolean", nullable=false)
     */
    private $explicit;

    /**
     * @var \Quizinformations
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Quizinformations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="QuizID", referencedColumnName="ID")
     * })
     */
    private $quizid;

    /**
     * Constructor
     */
    public function __construct($quizRef)
    {
        $this->tagid = new \Doctrine\Common\Collections\ArrayCollection();
        $id = $quizRef->getId();

        $this->quizid = $quizRef;
        $this->universalid = $this->generateUniversalID($id);
        $this->private = 0;
        $this->explicit = 0;
    }

    public function getUniversalid(): ?string
    {
        return $this->universalid;
    }

    public function setUniversalid(string $universalid): self
    {
        $this->universalid = $universalid;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRatingnumber(): ?int
    {
        return $this->ratingnumber;
    }

    public function setRatingnumber(int $ratingnumber): self
    {
        $this->ratingnumber = $ratingnumber;

        return $this;
    }

    public function getPlaynumber(): ?int
    {
        return $this->playnumber;
    }

    public function setPlaynumber(int $playnumber): self
    {
        $this->playnumber = $playnumber;

        return $this;
    }

    public function getExplicit(): ?bool
    {
        return $this->explicit;
    }

    public function setExplicit(bool $explicit): self
    {
        $this->explicit = $explicit;

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

    /**
     * @return Collection|Tags[]
     */
    public function getTagid(): Collection
    {
        return $this->tagid;
    }

    public function addTagid(Tags $tagid): self
    {
        if (!$this->tagid->contains($tagid)) {
            $this->tagid[] = $tagid;
        }

        return $this;
    }

    public function removeTagid(Tags $tagid): self
    {
        $this->tagid->removeElement($tagid);

        return $this;
    }

    public function generateUniversalID($QuizID){
        $QuizID = strrev($QuizID);
        $UniversalID = '';
        for($i = 5;$i >= 0; $i--){
            if(isset($QuizID[$i])){
                $UniversalID = $UniversalID.$QuizID[$i];
            }
            else{
                $UniversalID = $UniversalID.'0';
            }
            if($i == 3){
                $UniversalID = $UniversalID.'-';
            }
        }
        return $UniversalID;
    }

}
