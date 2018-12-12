<?php
namespace Ecommerce\Db\Cart\Item;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ecommerce\Db\Cart\Entity as CartEntity;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Table(name="ecommerce_cart_items")
 * @ORM\Entity(repositoryClass="Ecommerce\Db\Cart\Item\Repository")
 */
class Entity
{
	/**
	 * @var UuidInterface
	 *
	 * @ORM\Id
	 * @ORM\Column(type="uuid");
	 */
	private $id;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 */
	private $amount;

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(type="datetime");
	 */
	private $createdDate;

	/**
	 * @var CartEntity
	 *
	 * @ORM\ManyToOne(targetEntity="Ecommerce\Db\Cart\Entity", inversedBy="items")
	 * @ORM\JoinColumn(name="cartId", referencedColumnName="id", nullable=false)
	 */
	private $cart;

	/**
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->id          = Uuid::uuid4();
		$this->createdDate = new DateTime();
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
	public function getAmount(): int
	{
		return $this->amount;
	}

	/**
	 * @param int $amount
	 */
	public function setAmount(int $amount): void
	{
		$this->amount = $amount;
	}

	/**
	 * @return DateTime
	 */
	public function getCreatedDate(): DateTime
	{
		return $this->createdDate;
	}

	/**
	 * @param DateTime $createdDate
	 */
	public function setCreatedDate(DateTime $createdDate): void
	{
		$this->createdDate = $createdDate;
	}

	/**
	 * @return CartEntity
	 */
	public function getCart(): CartEntity
	{
		return $this->cart;
	}

	/**
	 * @param CartEntity $cart
	 */
	public function setCart(CartEntity $cart): void
	{
		$this->cart = $cart;
	}
}