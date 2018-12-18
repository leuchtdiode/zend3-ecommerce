<?php
namespace Ecommerce\Transaction;

use Common\Hydration\ArrayHydratable;
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
	 * @param Entity $entity
	 * @param Status $status
	 * @param PaymentMethod $paymentMethod
	 * @param Item[] $items
	 */
	public function __construct(Entity $entity, Status $status, PaymentMethod $paymentMethod, array $items)
	{
		$this->entity        = $entity;
		$this->status        = $status;
		$this->paymentMethod = $paymentMethod;
		$this->items         = $items;
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
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return UuidInterface
	 */
	public function getId()
	{
		return $this->entity->getId();
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}
}