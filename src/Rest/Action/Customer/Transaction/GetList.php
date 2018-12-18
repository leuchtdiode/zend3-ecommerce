<?php
namespace Ecommerce\Rest\Action\Customer\Transaction;

use Common\Db\FilterChain;
use Common\Hydration\ObjectToArrayHydrator;
use Ecommerce\Transaction\Provider;
use Ecommerce\Db\Transaction\Filter\Customer;
use Ecommerce\Rest\Action\Base;
use Ecommerce\Rest\Action\Response;
use Exception;

class GetList extends Base
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
	 * @return string
	 * @throws Exception
	 */
	public function executeAction()
	{
		$customerId = $this->getCustomer()->getId();

		$addresses = $this->provider->filter(
			FilterChain::create()
				->addFilter(
					Customer::is($customerId)
				)
		);

		return Response::is()
			->successful()
			->data(ObjectToArrayHydrator::hydrate(
				$addresses
			))
			->dispatch();
	}
}