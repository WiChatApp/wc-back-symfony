<?php

namespace App\Controller;

use App\Entity\Test;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test', name: 'app_test_')]
class TestController extends AbstractEntityController
{
	/**
	 * Create the entity controller
	 * 
	 * @param EntityManagerInterface $entityManager The entity management service
	 * 
	 * @return AbstractEntityController A controller for the application
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
		parent::__construct($entityManager, $entityManager->getRepository(Test::class));
	}

	#[Route('/create', name: 'create')]
	public function test(): Response
	{
		$testEntity = new Test();

		$testEntity->setTestField('expression');

		$this->getEntityManager()->persist($testEntity);
		$this->getEntityManager()->flush();

		return new Response($testEntity->getTestField());
	}
}
