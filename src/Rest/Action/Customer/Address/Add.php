<?php
namespace Ecommerce\Rest\Action\Customer\Address;

use Common\Hydration\ObjectToArrayHydrator;
use Ecommerce\Address\Adder;
use Ecommerce\Address\AddData as AddressAddData;
use Ecommerce\Rest\Action\Base;
use Ecommerce\Rest\Action\Response;
use Exception;

class Add extends Base
{
	/**
	 * @var AddData
	 */
	private $data;

	/**
	 * @var Adder
	 */
	private $adder;

	/**
	 * @param AddData $data
	 * @param Adder $adder
	 */
	public function __construct(AddData $data, Adder $adder)
	{
		$this->data  = $data;
		$this->adder = $adder;
	}

	/**
	 * @return string
	 * @throws Exception
	 */
	public function executeAction()
	{
		$customerId = $this
			->params()
			->fromRoute('id');

		if (!$this->customerCheck($customerId))
		{
			return $this->forbidden();
		}

		$values = $this->data
			->setRequest($this->getRequest())
			->getValues();

		if ($values->hasErrors())
		{
			return Response::is()
				->unsuccessful()
				->errors($values->getErrors())
				->dispatch();
		}

		$result = $this->adder->add(
			AddressAddData::create()
				->setCustomer($this->getCustomer())
				->setCountry(
					$values
						->get(AddData::COUNTRY)
						->getValue()
				)
				->setZip(
					$values
						->get(AddData::ZIP)
						->getValue()
				)
				->setCity(
					$values
						->get(AddData::CITY)
						->getValue()
				)
				->setStreet(
					$values
						->get(AddData::STREET)
						->getValue()
				)
				->setStreetExtra(
					$values
						->get(AddData::STREET_EXTRA)
						->getValue()
				)
				->setDefaultBilling(
					$values
						->get(AddData::DEFAULT_BILLING)
						->getValue() ?? false
				)
				->setDefaultShipping(
					$values
						->get(AddData::DEFAULT_SHIPPING)
						->getValue() ?? false
				)
		);

		if (!$result->isSuccess())
		{
			return Response::is()
				->unsuccessful()
				->errors($result->getErrors())
				->dispatch();
		}

		return Response::is()
			->successful()
			->data(
				ObjectToArrayHydrator::hydrate(
					AddSuccessData::create()
						->setAddress($result->getAddress())
				)
			)
			->dispatch();
	}
}