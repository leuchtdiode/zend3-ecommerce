<?php
namespace Ecommerce\Common;

use Ecommerce\Address\Creator as AddressCreator;
use Ecommerce\Customer\Creator as CustomerCreator;

class DtoCreatorProvider
{
	/**
	 * @var CustomerCreator
	 */
	private $customerCreator;

	/**
	 * @var AddressCreator
	 */
	private $addressCreator;

	/**
	 * @param CustomerCreator $customerCreator
	 * @param AddressCreator $addressCreator
	 */
	public function __construct(CustomerCreator $customerCreator, AddressCreator $addressCreator)
	{
		$this->customerCreator = $customerCreator;
		$this->addressCreator  = $addressCreator;
	}

	/**
	 * @return CustomerCreator
	 */
	public function getCustomerCreator(): CustomerCreator
	{
		return $this->customerCreator;
	}

	/**
	 * @return AddressCreator
	 */
	public function getAddressCreator(): AddressCreator
	{
		return $this->addressCreator;
	}
}