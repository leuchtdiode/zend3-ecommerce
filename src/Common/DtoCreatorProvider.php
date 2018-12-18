<?php
namespace Ecommerce\Common;

use Ecommerce\Address\Creator as AddressCreator;
use Ecommerce\Customer\Creator as CustomerCreator;
use Ecommerce\Product\Creator as ProductCreator;

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
	 * @var ProductCreator
	 */
	private $productCreator;

	/**
	 * @param CustomerCreator $customerCreator
	 * @param AddressCreator $addressCreator
	 * @param ProductCreator $productCreator
	 */
	public function __construct(
		CustomerCreator $customerCreator,
		AddressCreator $addressCreator,
		ProductCreator $productCreator
	)
	{
		$this->customerCreator = $customerCreator;
		$this->addressCreator  = $addressCreator;
		$this->productCreator  = $productCreator;
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

	/**
	 * @return ProductCreator
	 */
	public function getProductCreator(): ProductCreator
	{
		return $this->productCreator;
	}
}