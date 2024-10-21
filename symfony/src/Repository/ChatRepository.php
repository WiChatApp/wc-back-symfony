<?php

namespace App\Repository;

use App\Entity\Chat;
use Doctrine\Persistence\ManagerRegistry;

class ChatRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chat::class);
    }
}
