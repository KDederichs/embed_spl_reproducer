<?php

declare(strict_types=1);

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\DataFixtures\OrganisationFixture;
use App\DataFixtures\ProjectFixture;
use App\DataFixtures\UserFixture;
use App\Entity\Organisation;
use App\Entity\Project;
use App\Entity\User;
use App\Factory\OrganisationFactory;
use App\Factory\OrganisationMemberFactory;
use App\Factory\ProjectFactory;
use App\Factory\ProjectMemberFactory;
use App\Factory\UserFactory;
use Doctrine\ORM\EntityManagerInterface;
use Http\Mock\Client;
use Zenstruck\Browser\KernelBrowser;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

abstract class AbstractApiTest extends ApiTestCase
{
    use Factories;
    use HasBrowser;
    use ResetDatabase;

    protected function tearDown(): void
    {
        parent::tearDown();
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && !str_starts_with($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        /** @var EntityManagerInterface $em */
        $em = self::getContainer()->get(EntityManagerInterface::class);
        self::assertNotNull($em);
        //$userFixtures = new UserFixture();
        //$userFixtures->load($em);
        //$orgaFixture = new OrganisationFixture();
        //$orgaFixture->load($em);
        //$projectFixture = new ProjectFixture();
        //$projectFixture->load($em);
    }

    protected function getService(string $service): mixed
    {
        return self::getContainer()->get($service);
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return self::getContainer()->get(EntityManagerInterface::class);
    }

    protected function makeAuthenticatedClient(string $email): KernelBrowser
    {
        $user = UserFactory::find([
            'email' => $email,
        ]);

        self::assertNotNull($user);

        return $this
            ->browser()
            ->actingAs($user->object())
            ->setDefaultHttpOptions(['headers' => ['Content-Type' => 'application/json']]);
    }

    protected function assertRequiresAuthentication(string $path, string $method, array $headers = []): void
    {
        $response = $this
            ->browser()
            ->{$method}($path, [
                'headers' => array_merge(
                    ['Content-Type' => 'application/json'],
                    $headers,
                ),
                'body' => [],
            ])
            ->assertStatus(401)
            ->assertJson()
            ->json();

        $payload = $response->decoded();
        self::assertEquals('JWT Token not found', $payload['message']);
    }

    /**
     * @return array{
     *     user: User|Proxy,
     *     organisation: Organisation|Proxy,
     *     project: Project|Proxy
     * }
     */
    protected function makeTestUser(string $email, array $organisationRoles = [], array $projectRoles = []): array
    {
        $user = UserFactory::createOne([
            'email' => $email,
        ]);
        $organisation = OrganisationFactory::createOne();
        OrganisationMemberFactory::createOne([
            'user' => $user,
            'organisation' => $organisation,
            'roles' => $organisationRoles,
        ]);
        $project = ProjectFactory::createOne([
            'organisation' => $organisation,
        ]);
        ProjectMemberFactory::createOne([
            'user' => $user,
            'project' => $project,
            'roles' => $projectRoles,
        ]);

        return [
            'user' => $user,
            'organisation' => $organisation,
            'project' => $project,
        ];
    }

    protected function assertViolation(string $message, array $result): void
    {
        self::assertArrayHasKey('violations', $result);
        $violationStrings = array_map(static fn ($elem) => $elem['message'], $result['violations']);
        self::assertContains($message, $violationStrings);
    }

    protected function getMockClient(KernelBrowser $browser): Client
    {
        return $browser->client()->getContainer()->get('httplug.client.mock');
    }
}
