<?php
namespace Ecommerce\Cart;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Cart\Item\Item;
use Ecommerce\Db\Cart\Entity;
use Ramsey\Uuid\UuidInterface;

class Cart implements ArrayHydratable
{
	/**
	 * @var Entity
	 */
	private $entity;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Item[]
	 */
	private $items;

	/**
	 * @param Entity $entity
	 * @param Item[] $items
	 */
	public function __construct(Entity $entity, array $items)
	{
		$this->entity = $entity;
		$this->items  = $items;
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return UuidInterface
	 */
	public function getId()
	{
		return $this->entity->getId();
	}

	/**
	 * @return Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}