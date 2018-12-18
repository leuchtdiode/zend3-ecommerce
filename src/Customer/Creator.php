<?php
namespace Ecommerce\Customer;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Customer\Entity;

class Creator implements EntityDtoCreator
{
	/**
	 * @param Entity $entity
	 * @return Customer
	 */
	public function byEntity($entity)
	{
		return new Customer($entity);
	}
}