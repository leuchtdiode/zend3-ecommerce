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
	 * @param Price $price
	 * @param Value[] $attributeValues
	 */
	public function __construct(Entity $entity, Price $price, array $attributeValues)
	{
		$this->entity          = $entity;
		$this->price           = $price;
		$this->attributeValues = $attributeValues;
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
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}