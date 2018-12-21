<?php
namespace Ecommerce\Cart;

use Ecommerce\Cart\Item\Creator as CartItemCreator;
use Ecommerce\Common\EntityDtoCreator;
use Ecommerce\Db\Cart\Entity;
use Ecommerce\Db\Cart\Item\Entity as CartItemEntity;

class Creator implements EntityDtoCreator
{
	/**
	 * @var CartItemCreator
	 */
	private $cartItemCreator;

	/**
	 * @param CartItemCreator $cartItemCreator
	 */
	public function setCartItemCreator(CartItemCreator $cartItemCreator): void
	{
		$this->cartItemCreator = $cartItemCreator;
	}

	/**
	 * @param Entity $entity
	 * @return Cart
	 */
	public function byEntity($entity)
	{
		return new Cart(
			$entity,
			array_map(
				function (CartItemEntity $entity)
				{
					return $this->cartItemCreator->byEntity($entity);
				},
				$entity->getItems()->toArray()
			)
		);
	}
}