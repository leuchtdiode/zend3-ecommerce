<?php
namespace Ecommerce\Cart;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Cart\Entity;

class Creator implements EntityDtoCreator
{
	/**
	 * @param Entity $entity
	 * @return Cart
	 */
	public function byEntity($entity)
	{
		return new Cart($entity);
	}
}