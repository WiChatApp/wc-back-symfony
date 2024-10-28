<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_')]
abstract class AbstractEntityController extends AbstractController
{
	private EntityRepository $repository;
	private EntityManagerInterface $entityManager;

	/**
	 * Create the entity controller
	 * 
	 * @param EntityManagerInterface $entityManager The entity manager service
	 * @param EntityRepository $entityRepository The entity repository
	 * 
	 * @return AbstractEntityController An entity controller
	 */
	public function __construct(EntityManagerInterface $entityManager, EntityRepository $entityRepository)
	{
		$this->setEntityManager($entityManager);
		$this->setRepository($entityRepository);
	}

	/**
	 * Set the entity manager service
	 * 
	 * @param EntityManagerInterface $entityManager The entity manager service
	 * 
	 * @return AbstractEntityController The application controller
	 */
	public function setEntityManager(EntityManagerInterface $entityManager): static
	{
		$this->entityManager = $entityManager;
		return $this;
	}
	
	/**
	 * Get the entity manager service
	 * 
	 * @return EntityManagerInterface The entity manager service
	 */
	public function getEntityManager(): EntityManagerInterface
	{
		return $this->entityManager;
	}

	/**
	 * Set the entity repository
	 * 
	 * @param EntityRepository $repository The entity repository
	 * 
	 * @return AbstractEntityController The application controller
	 */
	public function setRepository(EntityRepository $repository): static
	{
		$this->repository = $repository;
		return $this;
	}

	/**
	 * Get the entity repository
	 * 
	 * @return EntityRepository The entity repository
	 */
	public function getRepository(): EntityRepository
	{
		return $this->repository;
	}
}
