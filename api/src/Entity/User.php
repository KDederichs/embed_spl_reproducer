<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Carbon\Carbon;
use Doctrine\ORM\Mapping\Cache;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[Entity(repositoryClass: UserRepository::class)]
#[Table(name: 'users')]
#[UniqueEntity(fields: ['email'])]
#[Cache(usage: 'NONSTRICT_READ_WRITE', region: 'write_rare')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_CUCA = 'ROLE_CUCA';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    #[Id]
    #[Column(type: UuidType::NAME)]
    private Uuid $id;
    #[Column]
    private \DateTimeImmutable $createdAt;
    #[Column(unique: true)]
    private string $email;
    #[Column]
    private string $timezone = 'Europe/Berlin';
    #[Column]
    private ?string $password = null;
    #[Column]
    private array $roles = [self::ROLE_USER];

    #[Column(nullable: true)]
    private ?string $firstName = null;
    #[Column(nullable: true)]
    private ?string $lastName = null;

    #[Column]
    private bool $disabled = false;
    #[Column(length: 10, options: ['default' => 'de'])]
    private string $locale = 'de';

    public function __construct()
    {
        $this->id = Uuid::v7();
        $this->createdAt = Carbon::now()->toDateTimeImmutable();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;

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

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getDisplayName(): string
    {
        return $this->email;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
