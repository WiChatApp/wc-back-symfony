<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ChatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
#[ApiResource]
// Prevent multiple chats with the same name
#[ORM\Table(name: 'chat')]
#[ORM\UniqueConstraint(name: 'chat_unique', columns: ['name'])]
class Chat extends AbstractEntity
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	protected ?int $id = null;

	#[ORM\Column(length: 255)]
	protected ?string $name = null;

	#[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'chat', orphanRemoval: true)]
	protected Collection $messages;

	#[ORM\OneToMany(targetEntity: Assignment::class, mappedBy: 'chat', orphanRemoval: true)]
	protected Collection $assignments;

	public function __construct(array $data = [])
	{
		parent::__construct($data);
		$this->messages = new ArrayCollection();
		$this->assignments = new ArrayCollection();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): static
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return Collection<int, Message>
	 */
	public function getMessages(): Collection
	{
		return $this->messages;
	}

	public function addMessage(Message $message): static
	{
		if (!$this->messages->contains($message)) {
			$this->messages->add($message);
			$message->setChat($this);
		}

		return $this;
	}

	public function removeMessage(Message $message): static
	{
		if ($this->messages->removeElement($message)) {
			// set the owning side to null (unless already changed)
			if ($message->getChat() === $this) {
				$message->setChat(null);
			}
		}

		return $this;
	}

	/**
	 * @return Collection<int, Assignment>
	 */
	public function getAssignments(): Collection
	{
		return $this->assignments;
	}

	public function addAssignment(Assignment $assignment): static
	{
		if (!$this->assignments->contains($assignment)) {
			$this->assignments->add($assignment);
			$assignment->setChat($this);
		}

		return $this;
	}

	public function removeAssignment(Assignment $assignment): static
	{
		if ($this->assignments->removeElement($assignment)) {
			// set the owning side to null (unless already changed)
			if ($assignment->getChat() === $this) {
				$assignment->setChat(null);
			}
		}

		return $this;
	}
}

