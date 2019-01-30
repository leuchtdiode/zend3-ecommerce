<?php
namespace Ecommerce\Rest\Action;

use Ecommerce\Customer\Customer;
use Ecommerce\Rest\Action\Plugin\Auth;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\MvcEvent;

/**
 * @method Auth auth()
 */
abstract class Base extends AbstractRestfulController
{
	/**
	 * @var Customer|null
	 */
	private $customer;

	/**
	 * @param MvcEvent $e
	 * @return mixed
	 */
	public function onDispatch(MvcEvent $e)
	{
		$request = $e->getRequest();

		if (!$this instanceof LoginExempt) // needs login
		{
			$authHeader = $request
				->getHeader('Authorization');

			if (!$authHeader)
			{
				return $this->forbidden();
			}

			$token = $authHeader->getFieldValue();

			if (!$token)
			{
				return $this->forbidden();
			}

			$result = $this->auth()->validateJwtToken($token);

			if (!$result->isValid())
			{
				return $this->forbidden();
			}

			$this->customer = $result->getCustomer();
		}

		return parent::onDispatch($e);
	}

	abstract public function executeAction();

	/**
	 * @return Customer|null
	 */
	protected function getCustomer(): ?Customer
	{
		return $this->customer;
	}

	/**
	 * @param string $customerId
	 * @return bool
	 */
	protected function customerCheck($customerId)
	{
		return $this->customer && $this->customer->getId()->toString() === $customerId;
	}

	/**
	 * @return mixed
	 */
	protected function forbidden()
	{
		return $this
			->getResponse()
			->setStatusCode(403);
	}

	/**
	 * @return mixed
	 */
	protected function notFound()
	{
		return $this
			->getResponse()
			->setStatusCode(404);
	}
}