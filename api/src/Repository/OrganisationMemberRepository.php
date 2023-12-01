<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Organisation;
use App\Entity\OrganisationMember;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

class OrganisationMemberRepository extends AbstractBaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrganisationMember::class);
    }
}
