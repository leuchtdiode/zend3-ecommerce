<?php
namespace Ecommerce\Payment\MethodHandler;

interface MethodHandler
{
	/**
	 * @param InitData $data
	 * @return InitResult
	 */
	public function init(InitData $data): InitResult;
}