<?php
namespace Ecommerce\Customer\Auth;

use Ecommerce\Customer\CouldNotFindCustomerError;
use Ecommerce\Customer\Provider;

class LoginHandler
{
	/**
	 * @var Provider
	 */
	private $customerProvider;

	/**
	 * @param Provider $customerProvider
	 */
	public function __construct(Provider $customerProvider)
	{
		$this->customerProvider = $customerProvider;
	}

	/**
	 * @param LoginData $data
	 * @return LoginResult
	 */
	public function login(LoginData $data)
	{
		$result = new LoginResult();
		$result->setSuccess(false);

		$customer = $this->customerProvider->byEmail(
			$data->getEmail()
		);

		if (!$customer)
		{
			$result->addError(CouldNotFindCustomerError::create());

			return $result;
		}

		if (!password_verify($data->getPassword(), $customer->getPassword()))
		{
			$result->addError(PasswordIncorrectError::create());

			return $result;
		}

		// TODO generate token

		$result->setSuccess(true);
		$result->setCustomer($customer);

		return $result;
	}
}