<?php

namespace App\Entity\panel;

use Doctrine\ORM\Mapping as ORM;

/**
 * Steamkeys
 *
 * @ORM\Table(name="steamKeys", uniqueConstraints={@ORM\UniqueConstraint(name="steamKey", columns={"steamKey"})})
 * @ORM\Entity
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
    private $steamid;

    /**
     * @var string
     *
     * @ORM\Column(name="steamKey", type="string", length=64, nullable=false)
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
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSteamid(): ?string
    {
        return $this->steamid;
    }

    public function setSteamid(?string $steamid): self
    {
        $this->steamid = $steamid;

        return $this;
    }

    public function getSteamkey(): ?string
    {
        return $this->steamkey;
    }

    public function setSteamkey(string $steamkey): self
    {
        $this->steamkey = $steamkey;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

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
