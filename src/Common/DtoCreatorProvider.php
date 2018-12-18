<?php
namespace Ecommerce\Common;

use Ecommerce\Customer\Creator as CustomerCreator;

class DtoCreatorProvider
{
	/**
	 * @var CustomerCreator
	 */
	private $customerCreator;

	/**
	 * @param CustomerCreator $customerCreator
	 */
	public function __construct(CustomerCreator $customerCreator)
	{
		$this->customerCreator = $customerCreator;
	}

	/**
	 * @return CustomerCreator
	 */
	public function getCustomerCreator(): CustomerCreator
	{
		return $this->customerCreator;
	}
}