<?php

declare(strict_types=1);

namespace App\Entity\Interface;

use App\Entity\Organisation;

interface OrganisationAware
{
    public function setOrganisation(Organisation $organisation);

    public function getOrganisation(): ?Organisation;
}
