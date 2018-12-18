<?php
namespace Ecommerce\Customer;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Db\Customer\Entity;

class Customer implements ArrayHydratable
{
	/**
	 * @var Entity
	 */
	private $entity;

	/**
	 * @param Entity $entity
	 */
	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return string
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
	public function getEmail()
	{
		return $this->entity->getEmail();
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->entity->getPassword();
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->entity->getFirstName();
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return string
	 */
	public function getLastName()
	{
		return $this->entity->getLastName();
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return null|string
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
	public function getCompany()
	{
		return $this->entity->getCompany();
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return null|string
	 */
	public function getTaxNumber()
	{
		return $this->entity->getTaxNumber();
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}