<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportsType
 *
 * @ORM\Table(name="Reports_Type")
 * @ORM\Entity(repositoryClass="App\Repository\aqg\ReportsTypeRepository")
 */
class ReportsType
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
     * @ORM\Column(name="Name", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="Lvl", type="integer", nullable=false)
     */
    private $lvl;

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

    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    public function setLvl(int $lvl): self
    {
        $this->lvl = $lvl;

        return $this;
    }


}
