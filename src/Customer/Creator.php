<?php
namespace Ecommerce\Customer;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Customer\Entity;

class Creator implements EntityDtoCreator
{
	/**
	 * @var StatusProvider
	 */
	private $statusProvider;

	/**
	 * @param StatusProvider $statusProvider
	 */
	public function __construct(StatusProvider $statusProvider)
	{
		$this->statusProvider = $statusProvider;
	}

	/**
	 * @param Entity $entity
	 * @return Customer
	 */
	public function byEntity($entity)
	{
		return new Customer(
			$entity,
			$this->statusProvider->byId($entity->getStatus())
		);
	}
}