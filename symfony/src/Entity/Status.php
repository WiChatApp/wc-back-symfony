<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
#[ApiResource]
// Prevent multiple statuses with the same description
#[ORM\Table(name: 'status')]
#[ORM\UniqueConstraint(name: 'status_unique', columns: ['description'])]
class Status extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
