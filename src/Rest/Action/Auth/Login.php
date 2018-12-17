<?php
namespace Ecommerce\Rest\Action\Auth;

use Ecommerce\Rest\Action\Base;
use Ecommerce\Rest\Action\Response;
use Exception;

class Login extends Base
{
	/**
	 * @var LoginData
	 */
	private $data;

	/**
	 * @param LoginData $data
	 */
	public function __construct(LoginData $data)
	{
		$this->data = $data;
	}

	/**
	 * @throws Exception
	 */
	public function executeAction()
	{
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

		return Response::is()
			->successful()
			->dispatch();
	}
}