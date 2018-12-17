<?php
namespace Ecommerce\Product\Attribute\Value;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Db\Product\Attribute\Value\Entity;

class Value implements ArrayHydratable
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