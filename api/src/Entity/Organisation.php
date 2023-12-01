<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OrganisationRepository;
use Doctrine\ORM\Mapping\Cache;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity(repositoryClass: OrganisationRepository::class)]
#[Cache(usage: 'NONSTRICT_READ_WRITE', region: 'write_rare')]
class Organisation
{
    #[Id, Column(type: UuidType::NAME)]
    private Uuid $id;
    #[Column(length: 150, nullable: true)]
    private ?string $organisationName = null;
    private array $allowedEmailDomains = [];
    private bool $ssoEnabled = false;

    public function __construct()
    {
        $this->id = Uuid::v7();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getOrganisationName(): ?string
    {
        return $this->organisationName;
    }

    public function setOrganisationName(?string $organisationName): self
    {
        $this->organisationName = $organisationName;

        return $this;
    }
}
