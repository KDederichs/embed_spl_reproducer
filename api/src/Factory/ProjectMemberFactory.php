<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\ProjectMember;
use App\Repository\ProjectMemberRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ProjectMember>
 *
 * @method        ProjectMember|Proxy                     create(array|callable $attributes = [])
 * @method static ProjectMember|Proxy                     createOne(array $attributes = [])
 * @method static ProjectMember|Proxy                     find(object|array|mixed $criteria)
 * @method static ProjectMember|Proxy                     findOrCreate(array $attributes)
 * @method static ProjectMember|Proxy                     first(string $sortedField = 'id')
 * @method static ProjectMember|Proxy                     last(string $sortedField = 'id')
 * @method static ProjectMember|Proxy                     random(array $attributes = [])
 * @method static ProjectMember|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ProjectMemberRepository|RepositoryProxy repository()
 * @method static ProjectMember[]|Proxy[]                 all()
 * @method static ProjectMember[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ProjectMember[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ProjectMember[]|Proxy[]                 findBy(array $attributes)
 * @method static ProjectMember[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ProjectMember[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ProjectMemberFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'disabled' => false,
            'project' => ProjectFactory::new(),
            'user' => UserFactory::new(),
            'roles' => [
            ],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this;
        // ->afterInstantiate(function(Member $member): void {})
    }

    protected static function getClass(): string
    {
        return ProjectMember::class;
    }
}
