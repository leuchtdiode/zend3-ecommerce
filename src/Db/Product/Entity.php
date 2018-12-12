<?php
namespace Ecommerce\Db\Product;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ecommerce\Db\Product\Attribute\Value\Entity as ProductAttributeValueEntity;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Table(name="ecommerce_products")
 * @ORM\Entity(repositoryClass="Ecommerce\Db\Product\Repository")
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
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255)
	 */
	private $title;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="text")
	 */
	private $description;

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(type="datetime");
	 */
	private $createdDate;

	/**
	 * @var ArrayCollection|ProductAttributeValueEntity[]
	 *
	 * @ORM\ManyToMany(targetEntity="Ecommerce\Db\Product\Attribute\Value\Entity")
	 * @ORM\JoinTable(name="ecommerce_products__attribute_values",
	 *      joinColumns={@ORM\JoinColumn(name="productId", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="productAttributeValueId", referencedColumnName="id")}
	 *      )
	 */
	private $attributeValues;

	/**
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->id              = Uuid::uuid4();
		$this->createdDate     = new DateTime();
		$this->attributeValues = new ArrayCollection();
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
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param string|null $description
	 */
	public function setDescription(?string $description): void
	{
		$this->description = $description;
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
	 * @return ArrayCollection|ProductAttributeValueEntity[]
	 */
	public function getAttributeValues()
	{
		return $this->attributeValues;
	}

	/**
	 * @param ArrayCollection|ProductAttributeValueEntity[] $attributeValues
	 */
	public function setAttributeValues($attributeValues): void
	{
		$this->attributeValues = $attributeValues;
	}
}