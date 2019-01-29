<?php
namespace Ecommerce\Transaction;

use Exception;
use Common\Db\FilterChain;
use Ecommerce\Common\DtoCreatorProvider;
use Ecommerce\Db\Transaction\Entity;
use Ecommerce\Db\Transaction\Repository;

class Provider
{
	/**
	 * @var DtoCreatorProvider
	 */
	private $dtoCreatorProvider;

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @param DtoCreatorProvider $dtoCreatorProvider
	 * @param Repository $repository
	 */
	public function __construct(DtoCreatorProvider $dtoCreatorProvider, Repository $repository)
	{
		$this->dtoCreatorProvider = $dtoCreatorProvider;
		$this->repository         = $repository;
	}

	/**
	 * @param string $id
	 * @return Transaction|null
	 * @throws Exception
	 */
	public function byId($id)
	{
		return ($entity = $this->repository->find($id))
			? $this->createDto($entity)
			: null;
	}

	/**
	 * @param FilterChain $filterChain
	 * @return Transaction[]
	 */
	public function filter(FilterChain $filterChain)
	{
		return $this->createDtos(
			$this->repository->filter($filterChain)
		);
	}

	/**
	 * @param Entity[] $entities
	 * @return Transaction[]
	 */
	private function createDtos(array $entities)
	{
		return array_map(
			function (Entity $entity)
			{
				return $this->createDto($entity);
			},
			$entities
		);
	}

	/**
	 * @param Entity $entity
	 * @return Transaction
	 * @throws Exception
	 */
	private function createDto(Entity $entity)
	{
		return $this->dtoCreatorProvider
			->getTransactionCreator()
			->byEntity($entity);
	}
}