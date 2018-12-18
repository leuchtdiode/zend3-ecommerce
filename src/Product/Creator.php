<?php
namespace Ecommerce\Product;

use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Common\PriceCreator;
use Ecommerce\Db\Product\Attribute\Value\Entity as ProductAttributeValueEntity;
use Ecommerce\Db\Product\Entity;
use Ecommerce\Product\Attribute\Value\Creator as ProductAttributeValueCreator;

class Creator implements EntityDtoCreator
{
	/**
	 * @var PriceCreator
	 */
	private $priceCreator;

	/**
	 * @var ProductAttributeValueCreator
	 */
	private $productAttributeValueCreator;

	/**
	 * @param PriceCreator $priceCreator
	 */
	public function __construct(PriceCreator $priceCreator)
	{
		$this->priceCreator = $priceCreator;
	}

	/**
	 * @param ProductAttributeValueCreator $productAttributeValueCreator
	 */
	public function setProductAttributeValueCreator(ProductAttributeValueCreator $productAttributeValueCreator): void
	{
		$this->productAttributeValueCreator = $productAttributeValueCreator;
	}

	/**
	 * @param Entity $entity
	 * @return Product
	 */
	public function byEntity($entity)
	{
		return new Product(
			$entity,
			$this->priceCreator->fromCents($entity->getPrice()),
			array_map(
				function (ProductAttributeValueEntity $entity)
				{
					return $this->productAttributeValueCreator->byEntity($entity);
				},
				$entity->getAttributeValues()->toArray()
			)
		);
	}
}