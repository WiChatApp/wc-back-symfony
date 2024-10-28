<?php

namespace App\Controller;

use App\Entity\Assignment;
use App\Entity\Chat;
use App\Entity\Permission;
use App\Entity\Role;
use App\Entity\Status;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractEntityController
{
	/**
	 * Create the entity controller
	 * 
	 * @param EntityManagerInterface $entityManager The entity manager service
	 * 
	 * @return AbstractEntityController A controller for the application
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
		parent::__construct($entityManager, $entityManager->getRepository(User::class));
	}

	#[Route('/adduser', name: 'user_create')]
	public function userCreate(): JsonResponse
	{
		$message = '';

		try {
			// If user 1 does not exist
			$userEntity = $this->getRepository()->find(1);
			if (!$userEntity) {
				$userEntity = new User([
					'nickname' => 'pseudo',
					'creationDate' => new \DateTime('now'),
				]);

				$message .= 'User created';
				
				$this->getEntityManager()->persist($userEntity);
				$message .= 'User saved';
			} else {
				$message .= 'User already exists';
			}

			$roleEntity = $this->getEntityManager()->getRepository(Role::class)->find(1);
			if (!$roleEntity) {
				$roleEntity = new Role([
					'name' => 'Administrator'
				]);
				$this->getEntityManager()->persist($roleEntity);
				$message .= 'Role created';
			} else {
				$message .= 'Role already exists';
			}

			$statusEntity = $this->getEntityManager()->getRepository(Status::class)->find(1);
			if (!$statusEntity) {
				$statusEntity = new Status([
					'description' => 'Online'
				]);
				$this->getEntityManager()->persist($statusEntity);
				$message .= 'Status created';
			} else {
				$message .= 'Status already exists';
			}

			$permissionEntity = $this->getEntityManager()->getRepository(Permission::class)->find(1);
			if (!$permissionEntity) {
				$permissionEntity = new Permission([
					'description' => 'Default'
				]);
				$this->getEntityManager()->persist($permissionEntity);
				$message .= 'Permission created';
			} else {
				$message .= 'Permission already exists';
			}

			$chatEntity = $this->getEntityManager()->getRepository(Chat::class)->find(1);
			if (!$chatEntity) {
				$chatEntity = new Chat([
					'name' => 'Chat'
				]);
				$this->getEntityManager()->persist($chatEntity);
				$message .= 'Chat created';
			} else {
				$message .= 'Chat already exists';
			}
						
			$assignment = new Assignment([
				'role' => $roleEntity,
				'status' => $statusEntity,
				'permission' => $permissionEntity,
				'chat' => $chatEntity,
				'user' => $userEntity
			]);
			$this->getEntityManager()->persist($assignment);
			$this->getEntityManager()->flush();
			$message .= 'Assignment saved';

		} catch (\Exception $e) {
			$message .= $e->getMessage();
		}

		return new JsonResponse([
			'message' => $message,
			'entity' => $userEntity->toArray()
		]);
	}
}
