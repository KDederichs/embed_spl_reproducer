<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Project;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class ProjectRepository extends AbstractBaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }
}
