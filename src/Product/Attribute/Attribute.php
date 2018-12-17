<?php
namespace Ecommerce\Product\Attribute;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Db\Product\Attribute\Entity;

class Attribute implements ArrayHydratable
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