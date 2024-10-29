<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Persistence\ManagerRegistry;

class MessageRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }
}
