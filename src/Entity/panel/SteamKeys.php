<?php

namespace App\Entity\panel;

use Doctrine\ORM\Mapping as ORM;

/**
 * Steamkeys
 *
 * @ORM\Table(name="steamKeys", uniqueConstraints={@ORM\UniqueConstraint(name="steamKey", columns={"steamKey"})})
 * @ORM\Entity(repositoryClass=SteamKeysRepository::class)
 */
class Steamkeys
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="steamId", type="string", length=64, nullable=true)
     */
    private $steamid;

    /**
     * @var string
     *
     * @ORM\Column(name="steamKey", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $steamkey;

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
     * @ORM\Column(name="date", type="date", nullable=false)
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