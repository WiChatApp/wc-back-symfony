<?php

namespace App\DataFixtures;

use App\Entity\Assignment;
use App\Entity\Chat;
use App\Entity\Message;
use App\Entity\Permission;
use App\Entity\Role;
use App\Entity\Status;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BaseFixtures extends Fixture
{
	public function load(ObjectManager $manager): void
	{
		$permissions = [
			'Free',
			'Muted',
			'Banned'
		];
		foreach ($permissions as $permission) {
			$entity = new Permission();
			$entity->setType($permission);
			$manager->persist($entity);
			// Replace the status with the entity in the array
			$index = array_search($permission, $permissions);
			$permissions[$index] = $entity;
		}

		$statuses = [
			'Offline',
			'Online',
		];
		foreach ($statuses as $status) {
			$entity = new Status();
			$entity->setDescription($status);
			$manager->persist($entity);
			// Replace the status with the entity in the array
			$index = array_search($status, $statuses);
			$statuses[$index] = $entity;
		}

		$roles = [
			'Administrator',
			'Guest',
		];
		foreach ($roles as $role) {
			$entity = new Role();
			$entity->setName($role);
			$manager->persist($entity);
			// Replace the role with the entity in the array
			$index = array_search($role, $roles);
			$roles[$index] = $entity;
		}

		$chats = [
			'Administrator Chat',
			'General Chat',
		];
		foreach ($chats as $chat) {
			$entity = new Chat();
			$entity->setName($chat);
			$manager->persist($entity);
			// Replace the chat with the entity in the array
			$index = array_search($chat, $chats);
			$chats[$index] = $entity;
		}

		$user = new User();
		$user->setNickname('Admin');
		$user->setPassword('aWC2324*');
		$user->setCreationDate(new \DateTime());
		$user->setStatus($statuses[0]);
		$manager->persist($user);

		$assignment = new Assignment();
		$assignment->setRole($roles[0]);
		$assignment->setPermission($permissions[0]);
		$assignment->setChat($chats[0]);
		$assignment->setUser($user);
		$manager->persist($assignment);

		$messages = [
			'Test message 1',
			'Test message 2',
		];
		foreach ($messages as $message) {
			$entity = new Message();
			$entity->setContent($message);
			$entity->setPostDate(new \DateTime());
			$entity->setUser($user);
			$entity->setChat($chats[0]);
			$manager->persist($entity);
		}

		$manager->flush();
	}
}
