<?php
namespace Ecommerce\Rest\Action\Customer\Address;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Address\Address;

class AddSuccessData implements ArrayHydratable
{
	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var Address
	 */
	private $address;

	/**
	 * @return AddSuccessData
	 */
	public static function create()
	{
		return new self();
	}

	/**
	 * @return Address
	 */
	public function getAddress(): Address
	{
		return $this->address;
	}

	/**
	 * @param Address $address
	 * @return AddSuccessData
	 */
	public function setAddress(Address $address): AddSuccessData
	{
		$this->address = $address;
		return $this;
	}
}