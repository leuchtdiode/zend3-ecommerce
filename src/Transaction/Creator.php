<?php
namespace Ecommerce\Transaction;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Transaction\Entity;
use Ecommerce\Db\Transaction\Item\Entity as TransactionItemEntity;
use Ecommerce\Transaction\Item\Creator as TransactionItemCreator;

class Creator implements EntityDtoCreator
{
	/**
	 * @var TransactionItemCreator
	 */
	private $transactionItemCreator;

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