<?php
namespace Ecommerce\Product;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Common\PriceCreator;
use Ecommerce\Db\Product\Entity;

class Creator implements EntityDtoCreator
{
	/**
	 * @var PriceCreator
	 */
	private $priceCreator;

	/**
	 * @param PriceCreator $priceCreator
	 */
	public function __construct(PriceCreator $priceCreator)
	{
		$this->priceCreator = $priceCreator;
	}

	/**
	 * @param Entity $entity
	 * @return Product
	 */
	public function byEntity($entity)
	{
		return new Product(
			$entity,
			$this->priceCreator->fromCents($entity->getPrice())
		);
	}
}