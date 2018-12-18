<?php
namespace Ecommerce\Transaction;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Transaction\Entity;
use Ecommerce\Db\Transaction\Item\Entity as TransactionItemEntity;
use Ecommerce\Transaction\Item\Creator as TransactionItemCreator;

class Creator implements EntityDtoCreator
{
	/**
	 * @var StatusProvider
	 */
	private $statusProvider;

	/**
	 * @var TransactionItemCreator
	 */
	private $transactionItemCreator;

	/**
	 * @param StatusProvider $statusProvider
	 */
	public function __construct(StatusProvider $statusProvider)
	{
		$this->statusProvider = $statusProvider;
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