<?php
namespace Ecommerce\Customer\Auth;

use Common\Util\ArrayCreator;
use Ecommerce\Customer\Customer;
use Mail\Mail\PlaceholderValues;

class ActivateMailSenderPlaceholderValues implements PlaceholderValues
{
	/**
	 * @var Customer
	 */
	private $customer;

	/**
	 * @return ActivateMailSenderPlaceholderValues
	 */
	public static function create()
	{
		return new self();
	}

	/**
	 * @param Customer $customer
	 * @return ActivateMailSenderPlaceholderValues
	 */
	public function setCustomer(Customer $customer): ActivateMailSenderPlaceholderValues
	{
		$this->customer = $customer;
		return $this;
	}

	/**
	 * @return array
	 */
	public function asArray()
	{
		return ArrayCreator::create()
			->add($this->customer, 'customer')
			->getArray();
	}
}