<?php
namespace Ecommerce\Customer;

use Common\Hydration\ArrayHydratable;
use DateTime;
use Ecommerce\Db\Customer\Entity;
use Ramsey\Uuid\UuidInterface;

class Customer implements ArrayHydratable
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
	 * @param Entity $entity
	 * @param Status $status
	 */
	public function __construct(Entity $entity, Status $status)
	{
		$this->entity = $entity;
		$this->status = $status;
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->getFirstName() . ' ' . $this->getLastName();
	}

	/**
	 * @return Status
	 */
	public function getStatus(): Status
	{
		return $this->status;
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
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return DateTime
	 */
	public function getCreatedDate()
	{
		return $this->entity->getCreatedDate();
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}