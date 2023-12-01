<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use App\Entity\Organisation;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Serializer\Annotation\Ignore;

trait OrganisationAwareTrait
{
    #[ManyToOne(targetEntity: Organisation::class)]
    #[JoinColumn(nullable: false)]
    #[Ignore]
    protected ?Organisation $organisation = null;

    public function getOrganisation(): ?Organisation
    {
        return $this->organisation;
    }

    public function setOrganisation(Organisation $organisation): void
    {
        $this->organisation = $organisation;
    }
}
