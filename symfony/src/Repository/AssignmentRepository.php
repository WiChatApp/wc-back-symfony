<?php

namespace App\Repository;

use App\Entity\Assignment;
use Doctrine\Persistence\ManagerRegistry;

class AssignmentRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assignment::class);
    }
}
