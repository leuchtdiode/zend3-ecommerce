<?php
namespace Ecommerce\Cart\Item;

use Ecommerce\Cart\Adder as CartAdder;
use Ecommerce\Db\Cart\Item\Entity as ItemEntity;
use Ecommerce\Db\Cart\Saver as CartEntitySaver;
use Ecommerce\Product\Provider as ProductProvider;
use Exception;
use Log\Log;

class Adder
{
	/**
	 * @var CartAdder
	 */
	private $cartAdder;

	/**
	 * @var ProductProvider
	 */
	private $productProvider;

	/**
	 * @var CartEntitySaver
	 */
	private $cartEntitySaver;

	/**
	 * @param CartAdder $cartAdder
	 * @param ProductProvider $productProvider
	 * @param CartEntitySaver $cartEntitySaver
	 */
	public function __construct(
		CartAdder $cartAdder,
		ProductProvider $productProvider,
		CartEntitySaver $cartEntitySaver
	)
	{
		$this->cartAdder = $cartAdder;
		$this->productProvider = $productProvider;
		$this->cartEntitySaver = $cartEntitySaver;
	}

	/**
	 * @param AddData $addData
	 * @return AddResult
	 */
	public function add(AddData $addData)
	{
		$result = new AddResult();
		$result->setSuccess(false);

		$cart = $addData->getCart();

		if (!$cart)
		{
			$cart = $this->cartAdder->add();
		}

		try
		{
			$product = $this->productProvider->byId(
				$addData->getProductId()
			);

			if (!$product)
			{
				return $result;
			}

			// TODO find if item already in

			$itemEntity = new ItemEntity();
			$itemEntity->setCart($cart->getEntity());
			$itemEntity->setQuantity($addData->getAmount());
			$itemEntity->setProduct($product->getEntity());

			$cart->getEntity()->getItems()->add($itemEntity);

			$this->cartEntitySaver->save($cart->getEntity());
		}
		catch (Exception $ex)
		{
			Log::error($ex);
		}

		return $result;
	}
}