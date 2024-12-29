<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssignmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssignmentRepository::class)]
#[ApiResource]
// Prevent multiple assignments with the same user and the same chat
#[ORM\Table(name: 'assignment')]
#[ORM\UniqueConstraint(name: 'assignment_unique', columns: ['user_id', 'chat_id'])]
class Assignment extends AbstractEntity
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	protected ?int $id = null;

	#[ORM\ManyToOne]
	#[ORM\JoinColumn(nullable: false)]
	protected ?Role $role = null;

	#[ORM\ManyToOne]
	#[ORM\JoinColumn(nullable: false)]
	protected ?Permission $permission = null;

	#[ORM\ManyToOne(inversedBy: 'assignments')]
	#[ORM\JoinColumn(nullable: false)]
	protected ?Chat $chat = null;

	#[ORM\ManyToOne(inversedBy: 'assignments')]
	#[ORM\JoinColumn(nullable: false)]
	protected ?User $user = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getRole(): ?Role
	{
		return $this->role;
	}

	public function setRole(?Role $role): static
	{
		$this->role = $role;

		return $this;
	}

	public function getPermission(): ?Permission
	{
		return $this->permission;
	}

	public function setPermission(?Permission $permission): static
	{
		$this->permission = $permission;

		return $this;
	}

	public function getChat(): ?Chat
	{
		return $this->chat;
	}

	public function setChat(?Chat $chat): static
	{
		$this->chat = $chat;

		return $this;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function setUser(?User $user): static
	{
		$this->user = $user;

		return $this;
	}
}
