<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Embeds\Address;
use App\Entity\Trait\OrganisationAwareTrait;
use App\Repository\ProjectRepository;
use Carbon\Carbon;
use Doctrine\ORM\Mapping\Cache;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[Entity(repositoryClass: ProjectRepository::class)]
#[Cache(usage: 'NONSTRICT_READ_WRITE', region: 'write_rare')]
class Project implements UserInterface
{
    use OrganisationAwareTrait;
    #[Id]
    #[Column(type: UuidType::NAME)]
    private Uuid $id;
    #[Column]
    private \DateTimeImmutable $createdAt;
    #[Column(length: 150, nullable: true)]
    private ?string $projectName = null;
    #[Column(type: 'string', length: 64, unique: true)]
    private string $apiKey;
    #[Embedded(class: Address::class)]
    private Address $invoiceAddress;



    public function __construct()
    {
        $this->id = Uuid::v7();
        $this->regenerateApiKey();
        $this->createdAt = Carbon::now()->toDateTimeImmutable();
        $this->invoiceAddress = new Address();
        var_dump('Project Project Address', spl_object_id($this));
        var_dump('Project Address Address',spl_object_id($this->getInvoiceAddress()));
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getProjectName(): ?string
    {
        return $this->projectName;
    }

    public function setProjectName(?string $projectName): self
    {
        $this->projectName = $projectName;

        return $this;
    }

    public function regenerateApiKey(): self
    {
        $this->apiKey = bin2hex(random_bytes(32));

        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_PROJECT'];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->apiKey;
    }




    public function getInvoiceAddress(): Address
    {
        return $this->invoiceAddress;
    }

    public function setInvoiceAddress(Address $invoiceAddress): self
    {
        $this->invoiceAddress = $invoiceAddress;

        return $this;
    }





}
