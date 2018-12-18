<?php
namespace Ecommerce\Common;

use Ecommerce\Address\Creator as AddressCreator;
use Ecommerce\Customer\Creator as CustomerCreator;
use Ecommerce\Product\Attribute\Value\Creator as ProductAttributeValueCreator;
use Ecommerce\Product\Attribute\Creator as ProductAttributeCreator;
use Ecommerce\Product\Creator as ProductCreator;
use Ecommerce\Transaction\Creator as TransactionCreator;
use Ecommerce\Transaction\Item\Creator as TransactionItemCreator;

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
	 * @var ProductAttributeCreator
	 */
	private $productAttributeCreator;

	/**
	 * @var ProductAttributeValueCreator
	 */
	private $productAttributeValueCreator;

	/**
	 * @var TransactionCreator
	 */
	private $transactionCreator;

	/**
	 * @var TransactionItemCreator
	 */
	private $transactionItemCreator;

	/**
	 * @param CustomerCreator $customerCreator
	 * @param AddressCreator $addressCreator
	 * @param ProductCreator $productCreator
	 * @param ProductAttributeCreator $productAttributeCreator
	 * @param ProductAttributeValueCreator $productAttributeValueCreator
	 * @param TransactionCreator $transactionCreator
	 * @param TransactionItemCreator $transactionItemCreator
	 */
	public function __construct(
		CustomerCreator $customerCreator,
		AddressCreator $addressCreator,
		ProductCreator $productCreator,
		ProductAttributeCreator $productAttributeCreator,
		ProductAttributeValueCreator $productAttributeValueCreator,
		TransactionCreator $transactionCreator,
		TransactionItemCreator $transactionItemCreator
	)
	{
		$this->customerCreator              = $customerCreator;
		$this->addressCreator               = $addressCreator;
		$this->productCreator               = $productCreator;
		$this->productAttributeCreator      = $productAttributeCreator;
		$this->productAttributeValueCreator = $productAttributeValueCreator;
		$this->transactionCreator           = $transactionCreator;
		$this->transactionItemCreator       = $transactionItemCreator;

		$this->handleDependencies();
	}

	/**
	 *
	 */
	private function handleDependencies()
	{
		$this->productAttributeValueCreator->setProductAttributeCreator($this->productAttributeCreator);
		$this->productCreator->setProductAttributeValueCreator($this->productAttributeValueCreator);
		$this->transactionCreator->setTransactionItemCreator($this->transactionItemCreator);
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

	/**
	 * @return ProductAttributeCreator
	 */
	public function getProductAttributeCreator(): ProductAttributeCreator
	{
		return $this->productAttributeCreator;
	}

	/**
	 * @return ProductAttributeValueCreator
	 */
	public function getProductAttributeValueCreator(): ProductAttributeValueCreator
	{
		return $this->productAttributeValueCreator;
	}

	/**
	 * @return TransactionCreator
	 */
	public function getTransactionCreator(): TransactionCreator
	{
		return $this->transactionCreator;
	}

	/**
	 * @return TransactionItemCreator
	 */
	public function getTransactionItemCreator(): TransactionItemCreator
	{
		return $this->transactionItemCreator;
	}
}