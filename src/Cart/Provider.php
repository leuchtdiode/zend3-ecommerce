<?php
namespace Ecommerce\Cart;

use Ecommerce\Common\DtoCreatorProvider;
use Ecommerce\Db\Cart\Entity;
use Ecommerce\Db\Cart\Repository;

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
	 * @return Cart|null
	 */
	public function byId($id)
	{
		return ($entity = $this->repository->find($id))
			? $this->createDto($entity)
			: null;
	}

	/**
	 * @param Entity $entity
	 * @return Cart
	 */
	private function createDto(Entity $entity)
	{
		return $this->dtoCreatorProvider
			->getCartCreator()
			->byEntity($entity);
	}
}