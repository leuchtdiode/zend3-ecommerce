<?php
namespace Ecommerce\Db\Transaction\Item;

use Doctrine\ORM\Mapping as ORM;
use Ecommerce\Db\Transaction\Entity as TransactionEntity;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Table(name="ecommerce_transaction_items")
 * @ORM\Entity(repositoryClass="Ecommerce\Db\Transaction\Item\Repository")
 */
class Entity
{
	/**
	 * @var UuidInterface
	 *
	 * @ORM\Id
	 * @ORM\Column(type="uuid")
	 */
	private $id;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 */
	private $price;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 */
	private $tax;

	/**
	 * @var TransactionEntity
	 *
	 * @ORM\ManyToOne(targetEntity="Ecommerce\Db\Transaction\Entity", inversedBy="items")
	 * @ORM\JoinColumn(name="transactionId", referencedColumnName="id", nullable=false)
	 */
	private $transaction;

	/**
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->id = Uuid::uuid4();
	}

	/**
	 * @return UuidInterface
	 */
	public function getId(): UuidInterface
	{
		return $this->id;
	}

	/**
	 * @param UuidInterface $id
	 */
	public function setId(UuidInterface $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getPrice(): int
	{
		return $this->price;
	}

	/**
	 * @param int $price
	 */
	public function setPrice(int $price): void
	{
		$this->price = $price;
	}

	/**
	 * @return int
	 */
	public function getTax(): int
	{
		return $this->tax;
	}

	/**
	 * @param int $tax
	 */
	public function setTax(int $tax): void
	{
		$this->tax = $tax;
	}

	/**
	 * @return TransactionEntity
	 */
	public function getTransaction(): TransactionEntity
	{
		return $this->transaction;
	}

	/**
	 * @param TransactionEntity $transaction
	 */
	public function setTransaction(TransactionEntity $transaction): void
	{
		$this->transaction = $transaction;
	}
}