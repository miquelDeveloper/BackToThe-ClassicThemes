<?php

namespace App\Entity;

use App\Repository\PartnerDataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartnerDataRepository::class)
 */
class PartnerData
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $partnerId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tradeName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartnerId(): ?int
    {
        return $this->partnerId;
    }

    public function setPartnerId(int $partnerId): self
    {
        $this->partnerId = $partnerId;

        return $this;
    }

    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    public function setTradeName(?string $tradeName): self
    {
        $this->tradeName = $tradeName;

        return $this;
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

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }
}
