<?php
namespace Ecommerce\Transaction\Item;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Common\Price;
use Ecommerce\Db\Transaction\Item\Entity;
use Ecommerce\Product\Product;
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
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Product
	 */
	private $product;

	/**
	 * @param Entity $entity
	 * @param Price $price
	 * @param Product $product
	 */
	public function __construct(Entity $entity, Price $price, Product $product)
	{
		$this->entity  = $entity;
		$this->price   = $price;
		$this->product = $product;
	}

	/**
	 * @return Product
	 */
	public function getProduct(): Product
	{
		return $this->product;
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return Price
	 */
	public function getTotalPrice()
	{
		$singleCents = $this->getPrice()->getNet();

		return Price::fromCents(
			$singleCents * $this->getAmount(),
			$this->getPrice()->getTaxRate()
		);
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
	 * @return int
	 */
	public function getAmount()
	{
		return $this->entity->getAmount();
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}