<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Organisation;
use Doctrine\Persistence\ManagerRegistry;

class OrganisationRepository extends AbstractBaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organisation::class);
    }
}
