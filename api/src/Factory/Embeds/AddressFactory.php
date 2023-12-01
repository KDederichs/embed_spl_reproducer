<?php

declare(strict_types=1);

namespace App\Factory\Embeds;

use App\Entity\Embeds\Address;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Address>
 *
 * @method        Address|Proxy     create(array|callable $attributes = [])
 * @method static Address|Proxy     createOne(array $attributes = [])
 * @method static Address[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Address[]|Proxy[] createSequence(iterable|callable $sequence)
 */
final class AddressFactory extends ModelFactory
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
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->withoutPersisting();
        // ->afterInstantiate(function(Address $address): void {})
    }

    protected static function getClass(): string
    {
        return Address::class;
    }
}
