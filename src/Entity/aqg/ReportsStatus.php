<?php

namespace App\Entity\aqg;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportsStatus
 *
 * @ORM\Table(name="Reports_status", uniqueConstraints={@ORM\UniqueConstraint(name="Name", columns={"Name"})})
 * @ORM\Entity(repositoryClass="App\Repository\aqg\ReportsStatusRepository")
 */
class ReportsStatus
{

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $name;

    public function getName(): ?string
    {
        return $this->name;
    }

}
