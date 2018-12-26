<?php
namespace Ecommerce\Payment\MethodHandler\PayPal;

use Ecommerce\Payment\MethodHandler\MethodHandler as MethodHandlerInterface;
use Ecommerce\Payment\MethodHandler\InitData;
use Ecommerce\Payment\MethodHandler\InitResult;

class MethodHandler implements MethodHandlerInterface
{
	/**
	 * @param InitData $data
	 * @return InitResult
	 */
	public function init(InitData $data): InitResult
	{
		$result = new InitResult();
		$result->setSuccess(true);

		// TODO implement me with PayPal SDK

		return $result;
	}
}