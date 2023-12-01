<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Interface\OrganisationAware;
use App\Entity\Trait\OrganisationAwareTrait;
use App\Repository\OrganisationMemberRepository;
use Carbon\Carbon;
use Doctrine\ORM\Mapping\Cache;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Uuid;

#[Entity(repositoryClass: OrganisationMemberRepository::class)]
#[UniqueConstraint(fields: ['user', 'organisation'])]
#[UniqueEntity(fields: ['user', 'organisation'])]
#[Cache(usage: 'NONSTRICT_READ_WRITE', region: 'write_rare')]
class OrganisationMember implements OrganisationAware
{
    use OrganisationAwareTrait;

    #[Id, Column(type: UuidType::NAME)]
    private Uuid $id;
    #[Column]
    private \DateTimeImmutable $createdAt;
    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $user;
    #[Column(type: 'json')]
    private array $roles = [];
    #[Column]
    private bool $disabled = false;

    public function __construct()
    {
        $this->id = Uuid::v7();
        $this->createdAt = Carbon::now()->toDateTimeImmutable();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function addRole(string $role): self
    {
        if (!\in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(string $role): self
    {
        if (\in_array($role, $this->roles, true)) {
            $this->roles = array_filter($this->roles, static fn (string $currentRole) => $currentRole !== $role);
        }

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;

        return $this;
    }
}
