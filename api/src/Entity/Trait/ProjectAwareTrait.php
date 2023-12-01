<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use App\Entity\Project;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Serializer\Annotation\Ignore;

trait ProjectAwareTrait
{
    #[ManyToOne(targetEntity: Project::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    #[Ignore]
    protected ?Project $project = null;

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(Project $project): void
    {
        $this->project = $project;
    }
}
