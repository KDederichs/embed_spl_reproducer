<?php

declare(strict_types=1);

namespace App\Tests\Functional\Project;

use App\Factory\OrganisationFactory;
use App\Factory\OrganisationMemberFactory;
use App\Factory\ProjectFactory;
use App\Factory\ProjectMemberFactory;
use App\Factory\UserFactory;
use App\Tests\AbstractApiTest;

class GetProjectTest extends AbstractApiTest
{
    public function testTest(): void
    {
        $userData = $this->makeTestUser('get@project.com');
        $user = UserFactory::find([
            'email' => $userData['user']->getEmail(),
        ]);
        self::assertNotNull($user);

         $this
            ->browser()
            ->actingAs($user->object())
            ->setDefaultHttpOptions(['headers' => ['Content-Type' => 'application/json']]);
            var_dump('Test Project Address', spl_object_id($userData['project']));
            var_dump('Test Address Address',spl_object_id($userData['project']->getInvoiceAddress()));
        $id = $userData['project']->getId();
    }
}
