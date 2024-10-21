<?php

namespace App\Repository;

use App\Entity\Permission;
use Doctrine\Persistence\ManagerRegistry;

class PermissionRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Permission::class);
    }
}
