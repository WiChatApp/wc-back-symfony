<?php

namespace App\Repository;

use App\Entity\Test;
use Doctrine\Persistence\ManagerRegistry;

class TestRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }
}
