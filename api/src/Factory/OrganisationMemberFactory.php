<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\OrganisationMember;
use App\Repository\OrganisationMemberRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<OrganisationMember>
 *
 * @method        OrganisationMember|Proxy                     create(array|callable $attributes = [])
 * @method static OrganisationMember|Proxy                     createOne(array $attributes = [])
 * @method static OrganisationMember|Proxy                     find(object|array|mixed $criteria)
 * @method static OrganisationMember|Proxy                     findOrCreate(array $attributes)
 * @method static OrganisationMember|Proxy                     first(string $sortedField = 'id')
 * @method static OrganisationMember|Proxy                     last(string $sortedField = 'id')
 * @method static OrganisationMember|Proxy                     random(array $attributes = [])
 * @method static OrganisationMember|Proxy                     randomOrCreate(array $attributes = [])
 * @method static OrganisationMemberRepository|RepositoryProxy repository()
 * @method static OrganisationMember[]|Proxy[]                 all()
 * @method static OrganisationMember[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static OrganisationMember[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static OrganisationMember[]|Proxy[]                 findBy(array $attributes)
 * @method static OrganisationMember[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static OrganisationMember[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class OrganisationMemberFactory extends ModelFactory
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
            'organisation' => OrganisationFactory::new(),
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
        // ->afterInstantiate(function(OrganisationMember $organisationMember): void {})
    }

    protected static function getClass(): string
    {
        return OrganisationMember::class;
    }
}
