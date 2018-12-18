<?php
namespace Ecommerce\Transaction\Item;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Common\Price;
use Ecommerce\Db\Transaction\Item\Entity;
use Ramsey\Uuid\UuidInterface;

class Item implements ArrayHydratable
{
	/**
	 * @var Entity
	 */
	private $entity;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Price
	 */
	private $price;

	/**
	 * @param Entity $entity
	 * @param Price $price
	 */
	public function __construct(Entity $entity, Price $price)
	{
		$this->entity = $entity;
		$this->price  = $price;
	}

	/**
	 * @return Price
	 */
	public function getPrice(): Price
	{
		return $this->price;
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
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}