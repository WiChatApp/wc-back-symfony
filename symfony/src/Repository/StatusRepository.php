<?php

namespace App\Repository;

use App\Entity\Status;
use Doctrine\Persistence\ManagerRegistry;

class StatusRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Status::class);
    }
}
