<?php
namespace Ecommerce\Cart\Item;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Db\Cart\Item\Entity;

class Item implements ArrayHydratable
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