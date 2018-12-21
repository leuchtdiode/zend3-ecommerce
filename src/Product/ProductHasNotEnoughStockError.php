<?php
namespace Ecommerce\Product;

use Common\Error;
use Common\Translator;

class ProductHasNotEnoughStockError extends Error
{
	/**
	 * @return ProductHasNotEnoughStockError
	 */
	public static function create()
	{
		return new self();
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return string
	 */
	public function getCode()
	{
		return 'PRODUCT_HAS_NOT_ENOUGH_STOCK';
	}

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @return string
	 */
	public function getMessage()
	{
		return Translator::translate('Nicht genügend lagernd');
	}
}