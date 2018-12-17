<?php
namespace Ecommerce\Customer;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Db\Customer\Entity;

class Customer implements ArrayHydratable
{
	/**
	 * @var Entity
	 */
	private $entity;

	/**
	 * @param Entity $entity
	 */
	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}