<?php
namespace Ecommerce\Rest\Action\Customer;

use Common\Hydration\ObjectToArrayHydrator;
use Ecommerce\Customer\Provider;
use Ecommerce\Rest\Action\Base;
use Ecommerce\Rest\Action\Response;
use Exception;

class Get extends Base
{
	/**
	 * @var Provider
	 */
	private $provider;

	/**
	 * @param Provider $provider
	 */
	public function __construct(Provider $provider)
	{
		$this->provider = $provider;
	}

	/**
	 * @throws Exception
	 */
	public function executeAction()
	{
		$customer = $this->getCustomer();

		$customerId = $this->params()->fromRoute('id');

		if ($customerId !== $customer->getId()->toString())
		{
			return $this->forbidden();
		}

		return Response::is()
			->successful()
			->data(
				ObjectToArrayHydrator::hydrate(
					GetSuccessData::create()
						->setCustomer($customer)
				)
			)
			->dispatch();
	}
}