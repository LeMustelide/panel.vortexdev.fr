<?php

namespace App\Entity\panel;

use App\Repository\panel\SteamKeysRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * SteamKeys
 * 
 * @ORM\table(name="steamKeys", uniqueConstraints={@ORM\UniqueConstraint(name="steamKey", columns={"steamKey"})})
 * @ORM\Entity(repositoryClass=SteamKeysRepository::class)
 */
class SteamKeys
{

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $steamId;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=64, nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $steamKey;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $tag;

    /**
     * @ORM\Column(type="date", length=24, nullable=false)
     */
    private $date;

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

    public function setSteamKey(string $steamKey): self
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

    public function getdate(): ?string
    {
        return $this->date;
    }

    public function setdate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }
}
