<?php
namespace Ecommerce\Transaction\Item;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Transaction\Item\Entity;

class Creator implements EntityDtoCreator
{
	/**
	 * @param Entity $entity
	 * @return Item
	 */
	public function byEntity($entity)
	{
		return new Item($entity);
	}
}