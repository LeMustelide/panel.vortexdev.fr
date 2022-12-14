<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apikey
 *
 * @ORM\Table(name="ApiKey", uniqueConstraints={@ORM\UniqueConstraint(name="ApiKey", columns={"ApiKey"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\ApikeyRepository")
 */
class Apikey
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ApiKey", type="string", length=1024, nullable=false)
     */
    private $apikey;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=12, nullable=false)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=64, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationDate", type="datetime", nullable=false)
     */
    private $creationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LastUse", type="datetime", nullable=false)
     */
    private $lastuse;

    /**
     * @var int
     *
     * @ORM\Column(name="disable", type="integer", nullable=true)
     */
    private $disable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApikey(): ?string
    {
        return $this->apikey;
    }

    public function setApikey(string $apikey): self
    {
        $this->apikey = $apikey;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreationdate(): ?\DateTimeInterface
    {
        return $this->creationdate;
    }

    public function setCreationdate(\DateTimeInterface $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getLastuse(): ?\DateTimeInterface
    {
        return $this->lastuse;
    }

    public function setLastuse(\DateTimeInterface $lastuse): self
    {
        $this->lastuse = $lastuse;

        return $this;
    }

    public function getDisable(): ?int
    {
        return $this->disable;
    }

    public function setDisable(int $disable): self
    {
        $this->disable = $disable;

        return $this;
    }


}
