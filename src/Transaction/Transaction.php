<?php
namespace Ecommerce\Transaction;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Address\Address;
use Ecommerce\Db\Transaction\Entity;
use Ecommerce\Payment\Method as PaymentMethod;
use Ecommerce\Transaction\Item\Item;
use Ramsey\Uuid\UuidInterface;

class Transaction implements ArrayHydratable
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
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var PaymentMethod
	 */
	private $paymentMethod;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Item[]
	 */
	private $items;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Address
	 */
	private $billingAddress;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Address
	 */
	private $shippingAddress;

	/**
	 * @param Entity $entity
	 * @param Status $status
	 * @param PaymentMethod $paymentMethod
	 * @param Item[] $items
	 * @param Address $billingAddress
	 * @param Address $shippingAddress
	 */
	public function __construct(
		Entity $entity,
		Status $status,
		PaymentMethod $paymentMethod,
		array $items,
		Address $billingAddress,
		Address $shippingAddress
	)
	{
		$this->entity          = $entity;
		$this->status          = $status;
		$this->paymentMethod   = $paymentMethod;
		$this->items           = $items;
		$this->billingAddress  = $billingAddress;
		$this->shippingAddress = $shippingAddress;
	}

	/**
	 * @return Status
	 */
	public function getStatus(): Status
	{
		return $this->status;
	}

	/**
	 * @return PaymentMethod
	 */
	public function getPaymentMethod(): PaymentMethod
	{
		return $this->paymentMethod;
	}

	/**
	 * @return Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @return Address
	 */
	public function getBillingAddress(): Address
	{
		return $this->billingAddress;
	}

	/**
	 * @return Address
	 */
	public function getShippingAddress(): Address
	{
		return $this->shippingAddress;
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
	public function getReferenceNumber()
	{
		return $this->entity->getReferenceNumber();
	}

	/**
	 * @return string|null
	 */
	public function getForeignId()
	{
		return $this->entity->getForeignId();
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}