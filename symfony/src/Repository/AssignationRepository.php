<?php

namespace App\Repository;

use App\Entity\Assignation;
use Doctrine\Persistence\ManagerRegistry;

class AssignationRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assignation::class);
    }
}
