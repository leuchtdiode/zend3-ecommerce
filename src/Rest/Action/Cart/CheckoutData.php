<?php
namespace Ecommerce\Rest\Action\Cart;

use Common\RequestData\Data;
use Common\RequestData\PropertyDefinition\Text;
use Common\RequestData\PropertyDefinition\Uuid;
use Ecommerce\Payment\MethodValidator;

class CheckoutData extends Data
{
	/**
	 * @return array
	 */
	public function getDefinitions()
	{
		return [
			Text::create()
				->setName('paymentMethod')
				->addValidator($this->container->get(MethodValidator::class))
				->setRequired(true),
			Uuid::create()
				->setName('billingAddressId')
				->setRequired(true),
			Uuid::create()
				->setName('shippingAddressId')
				->setRequired(true)
		];
	}
}