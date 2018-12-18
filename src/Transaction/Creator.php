<?php
namespace Ecommerce\Transaction;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Transaction\Entity;
use Ecommerce\Db\Transaction\Item\Entity as TransactionItemEntity;
use Ecommerce\Payment\MethodProvider as PaymentMethodProvider;
use Ecommerce\Transaction\Item\Creator as TransactionItemCreator;

class Creator implements EntityDtoCreator
{
	/**
	 * @var StatusProvider
	 */
	private $statusProvider;

	/**
	 * @var PaymentMethodProvider
	 */
	private $paymentMethodProvider;

	/**
	 * @var TransactionItemCreator
	 */
	private $transactionItemCreator;

	/**
	 * @param StatusProvider $statusProvider
	 * @param PaymentMethodProvider $paymentMethodProvider
	 */
	public function __construct(StatusProvider $statusProvider, PaymentMethodProvider $paymentMethodProvider)
	{
		$this->statusProvider        = $statusProvider;
		$this->paymentMethodProvider = $paymentMethodProvider;
	}

	/**
	 * @param TransactionItemCreator $transactionItemCreator
	 */
	public function setTransactionItemCreator(TransactionItemCreator $transactionItemCreator): void
	{
		$this->transactionItemCreator = $transactionItemCreator;
	}

	/**
	 * @param Entity $entity
	 * @return Transaction
	 */
	public function byEntity($entity)
	{
		return new Transaction(
			$entity,
			$this->statusProvider->byId($entity->getStatus()),
			$this->paymentMethodProvider->byId($entity->getPaymentMethod()),
			array_map(
				function (TransactionItemEntity $entity)
				{
					return $this->transactionItemCreator->byEntity($entity);
				},
				$entity->getItems()->toArray()
			)
		);
	}
}