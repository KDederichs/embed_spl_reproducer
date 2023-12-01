<?php

declare(strict_types=1);

namespace App\Entity\Embeds;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Address
{
    #[Column(nullable: true)]
    private ?string $firstName = null;
    #[Column(nullable: true)]
    private ?string $lastName = null;
    #[Column(nullable: true)]
    private ?string $companyName = null;
    #[Column(length: 10, nullable: true)]
    private ?string $zipCode = null;
    #[Column(nullable: true)]
    private ?string $city = null;
    #[Column(length: 2, nullable: true)]
    private ?string $country = null;
    #[Column(nullable: true)]
    private ?string $street = null;
    #[Column(nullable: true)]
    private ?string $houseNumber = null;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(?string $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }
}
