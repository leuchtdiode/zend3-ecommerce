<?php
namespace Ecommerce\Transaction;

use Ecommerce\Address\Creator as AddressCreator;
use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Transaction\Entity;
use Ecommerce\Db\Transaction\Item\Entity as TransactionItemEntity;
use Ecommerce\Payment\MethodProvider as PaymentMethodProvider;
use Ecommerce\Transaction\Item\Creator as TransactionItemCreator;
use Exception;

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
	 * @var AddressCreator
	 */
	private $addressCreator;

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
	 * @param AddressCreator $addressCreator
	 */
	public function setAddressCreator(AddressCreator $addressCreator): void
	{
		$this->addressCreator = $addressCreator;
	}

	/**
	 * @param Entity $entity
	 * @return Transaction
	 * @throws Exception
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
			),
			$this->addressCreator->byEntity($entity->getBillingAddress()),
			$this->addressCreator->byEntity($entity->getShippingAddress())
		);
	}
}