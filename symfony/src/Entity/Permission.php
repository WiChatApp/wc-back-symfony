<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PermissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionRepository::class)]
#[ApiResource]
// Prevent multiple permissions of the same type
#[ORM\Table(name: 'permission')]
#[ORM\UniqueConstraint(name: 'permission_unique', columns: ['type'])]
class Permission extends AbstractEntity
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	protected ?int $id = null;

	#[ORM\Column(length: 63)]
	protected ?string $type = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function setType(string $type): static
	{
		$this->type = $type;

		return $this;
	}
}
