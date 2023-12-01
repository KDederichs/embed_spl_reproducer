<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Interface\ProjectAware;
use App\Repository\ProjectMemberRepository;
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

#[ApiResource]
#[Get]
#[GetCollection]
#[Entity(repositoryClass: ProjectMemberRepository::class)]
#[UniqueEntity(fields: ['project', 'user'])]
#[UniqueConstraint(fields: ['project', 'user'])]
#[Cache(usage: 'NONSTRICT_READ_WRITE', region: 'write_rare')]
class ProjectMember implements ProjectAware
{
    #[Id]
    #[Column(type: UuidType::NAME)]
    private Uuid $id;
    #[Column]
    private \DateTimeImmutable $createdAt;
    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $user;
    #[ManyToOne(targetEntity: Project::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Project $project;
    #[Column(type: 'json', options: ['jsonb' => true])]
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

    public function getProject(): Project
    {
        return $this->project;
    }

    public function setProject(Project $project): self
    {
        $this->project = $project;

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
}
