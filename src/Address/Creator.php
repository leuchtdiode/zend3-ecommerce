<?php
namespace Ecommerce\Address;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Address\Entity;

class Creator implements EntityDtoCreator
{
	/**
	 * @param Entity $entity
	 * @return Address
	 */
	public function byEntity($entity)
	{
		return new Address($entity);
	}
}