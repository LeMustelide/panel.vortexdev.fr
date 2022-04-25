<?php

namespace App\Entity\panel;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SteamKeys
 *
 * @ORM\Table(name="steamKeys", uniqueConstraints={@ORM\UniqueConstraint(name="steamKey", columns={"steamKey"})})
 * @ORM\Entity(repositoryClass="App\Repository\panel\SteamKeysRepository")
 */
class SteamKeys
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="steamId", type="string", length=64, nullable=true)
     */
    private $steamId;

    /**
     * @var string
     *
     * @ORM\Column(name="steamKey", type="string", length=64, nullable=false)
     */
    private $steamKey; 

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=64, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tag", type="string", length=64, nullable=true)
     */
    private $tag;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSteamId(): ?string
    {
        return $this->steamId;
    }

    public function setSteamId(?string $steamId): self
    {
        $this->steamId = $steamId;

        return $this;
    }

    public function getSteamKey(): ?string
    {
        return $this->steamKey;
    }

    public function setSteamKey(?string $steamKey): self
    {
        $this->steamKey = $steamKey;

        return $this;
    }

    public function getdescription(): ?string
    {
        return $this->description;
    }

    public function setdescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function gettag(): ?string
    {
        return $this->tag;
    }

    public function settag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getdate(): ?\DateTime
    {
        return $this->date;
    }

    public function setdate(?\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

}
