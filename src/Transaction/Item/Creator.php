<?php
namespace Ecommerce\Transaction\Item;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Common\PriceCreator;
use Ecommerce\Db\Transaction\Item\Entity;

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
	 * @return Item
	 */
	public function byEntity($entity)
	{
		return new Item(
			$entity,
			$this->priceCreator->fromCents($entity->getPrice(), $entity->getTax())
		);
	}
}