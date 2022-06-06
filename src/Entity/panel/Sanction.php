<?php

namespace App\Entity\panel;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sanction
 *
 * @ORM\Table(name="sanction", indexes={@ORM\Index(name="user", columns={"user"}), @ORM\Index(name="action", columns={"action"})})
 * @ORM\Entity(repositoryClass="App\Repository\panel\SanctionRepository")
 */
class Sanction
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
     * @var string
     *
     * @ORM\Column(name="steamId", type="string", length=64, nullable=false)
     */
    private $steamid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reason", type="string", length=240, nullable=true)
     */
    private $reason;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \ActionType
     *
     * @ORM\ManyToOne(targetEntity="ActionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action", referencedColumnName="id")
     * })
     */
    private $action;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSteamid(): ?string
    {
        return $this->steamid;
    }

    public function setSteamid(string $steamid): self
    {
        $this->steamid = $steamid;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

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

    public function getAction(): ?ActionType
    {
        return $this->action;
    }

    public function setAction(?ActionType $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
