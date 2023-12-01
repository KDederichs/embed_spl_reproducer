<?php

declare(strict_types=1);

namespace App\Entity\Interface;

use App\Entity\Project;

interface ProjectAware
{
    public function setProject(Project $project);

    public function getProject(): ?Project;
}
