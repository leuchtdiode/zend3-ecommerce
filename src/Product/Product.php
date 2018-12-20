<?php
namespace Ecommerce\Product;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Common\Price;
use Ecommerce\Db\Product\Entity;
use Ecommerce\Product\Attribute\Value\Value;
use Ramsey\Uuid\UuidInterface;

class Product implements ArrayHydratable
{
	/**
	 * @var Entity
	 */
	private $entity;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Status
	 */
	private $status;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Price
	 */
	private $price;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Value[]
	 */
	private $attributeValues;

	/**
	 * @param Entity $entity
	 * @param Status $status
	 * @param Price $price
	 * @param Value[] $attributeValues
	 */
	public function __construct(Entity $entity, Status $status, Price $price, array $attributeValues)
	{
		$this->entity          = $entity;
		$this->status          = $status;
		$this->price           = $price;
		$this->attributeValues = $attributeValues;
	}

	/**
	 * @return Status
	 */
	public function getStatus(): Status
	{
		return $this->status;
	}

	/**
	 * @return Value[]
	 */
	public function getAttributeValues(): array
	{
		return $this->attributeValues;
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
	 * @return bool
	 */
	public function isInStock()
	{
		return $this->getStock() > 0;
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
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->entity->getTitle();
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return null|string
	 */
	public function getDescription()
	{
		return $this->entity->getDescription();
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return integer
	 */
	public function getStock()
	{
		return $this->entity->getStock();
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}