<?php
namespace Ecommerce\Address;

use Ecommerce\Customer\Customer;

class AddData
{
	/**
	 * @var Customer
	 */
	private $customer;

	/**
	 * @var string
	 */
	private $country;

	/**
	 * @var string
	 */
	private $zip;

	/**
	 * @var string
	 */
	private $city;

	/**
	 * @var string
	 */
	private $street;

	/**
	 * @var string|null
	 */
	private $streetExtra;

	/**
	 * @var bool
	 */
	private $defaultBilling;

	/**
	 * @var bool
	 */
	private $defaultShipping;

	/**
	 * @return AddData
	 */
	public static function create()
	{
		return new self();
	}

	/**
	 * @return Customer
	 */
	public function getCustomer(): Customer
	{
		return $this->customer;
	}

	/**
	 * @param Customer $customer
	 * @return AddData
	 */
	public function setCustomer(Customer $customer): AddData
	{
		$this->customer = $customer;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCountry(): string
	{
		return $this->country;
	}

	/**
	 * @param string $country
	 * @return AddData
	 */
	public function setCountry(string $country): AddData
	{
		$this->country = $country;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getZip(): string
	{
		return $this->zip;
	}

	/**
	 * @param string $zip
	 * @return AddData
	 */
	public function setZip(string $zip): AddData
	{
		$this->zip = $zip;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCity(): string
	{
		return $this->city;
	}

	/**
	 * @param string $city
	 * @return AddData
	 */
	public function setCity(string $city): AddData
	{
		$this->city = $city;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getStreet(): string
	{
		return $this->street;
	}

	/**
	 * @param string $street
	 * @return AddData
	 */
	public function setStreet(string $street): AddData
	{
		$this->street = $street;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getStreetExtra(): ?string
	{
		return $this->streetExtra;
	}

	/**
	 * @param string|null $streetExtra
	 * @return AddData
	 */
	public function setStreetExtra(?string $streetExtra): AddData
	{
		$this->streetExtra = $streetExtra;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDefaultBilling(): bool
	{
		return $this->defaultBilling;
	}

	/**
	 * @param bool $defaultBilling
	 * @return AddData
	 */
	public function setDefaultBilling(bool $defaultBilling): AddData
	{
		$this->defaultBilling = $defaultBilling;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDefaultShipping(): bool
	{
		return $this->defaultShipping;
	}

	/**
	 * @param bool $defaultShipping
	 * @return AddData
	 */
	public function setDefaultShipping(bool $defaultShipping): AddData
	{
		$this->defaultShipping = $defaultShipping;
		return $this;
	}
}