<?php
namespace Ecommerce\Rest\Action\Product;

use Common\Db\FilterChain;
use Common\Hydration\ObjectToArrayHydrator;
use Ecommerce\Product\Provider;
use Ecommerce\Rest\Action\Base;
use Ecommerce\Rest\Action\LoginExempt;
use Ecommerce\Rest\Action\Response;
use Exception;
use Zend\View\Model\JsonModel;

class GetList extends Base implements LoginExempt
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
	 * @return JsonModel
	 * @throws Exception
	 */
	public function executeAction()
	{
		$filterChain = FilterChain::create();

		$products = $this->provider->filter($filterChain);

		return Response::is()
			->successful()
			->data(
				ObjectToArrayHydrator::hydrate(
					$products
				)
			)
			->dispatch();
	}
}