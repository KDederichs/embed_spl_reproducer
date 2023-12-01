<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ProjectMember;
use Doctrine\Persistence\ManagerRegistry;

class ProjectMemberRepository extends AbstractBaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectMember::class);
    }

}
