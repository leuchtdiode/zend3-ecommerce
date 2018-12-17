<?php
namespace Ecommerce\Cart;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Db\Cart\Entity;

class Cart implements ArrayHydratable
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