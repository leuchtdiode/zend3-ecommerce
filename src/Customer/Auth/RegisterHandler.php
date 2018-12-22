<?php
namespace Ecommerce\Customer\Auth;

use Ecommerce\Customer\CustomerWithEmailAlreadyExistsError;
use Ecommerce\Customer\Provider;
use Ecommerce\Db\Customer\Entity;
use Ecommerce\Db\Customer\Saver;
use Exception;
use Log\Log;

class RegisterHandler
{
	/**
	 * @var Provider
	 */
	private $customerProvider;

	/**
	 * @var Saver
	 */
	private $entitySaver;

	/**
	 * @var PasswordHandler
	 */
	private $passwordHandler;

	/**
	 * @param Provider $customerProvider
	 * @param Saver $entitySaver
	 * @param PasswordHandler $passwordHandler
	 */
	public function __construct(Provider $customerProvider, Saver $entitySaver, PasswordHandler $passwordHandler)
	{
		$this->customerProvider = $customerProvider;
		$this->entitySaver      = $entitySaver;
		$this->passwordHandler  = $passwordHandler;
	}

	/**
	 * @param RegisterData $data
	 * @return RegisterResult
	 */
	public function register(RegisterData $data)
	{
		$result = new RegisterResult();
		$result->setSuccess(false);

		$email = $data->getEmail();

		if ($this->customerProvider->byEmail($email))
		{
			$result->addError(CustomerWithEmailAlreadyExistsError::create($email));

			return $result;
		}

		if ($data->getPassword() !== $data->getPasswordVerify())
		{
			$result->addError(CustomerWithEmailAlreadyExistsError::create($email));

			return $result;
		}

		try
		{
			$entity = new Entity();
			$entity->setEmail($email);
			$entity->setPassword(
				$this->passwordHandler->hash($data->getPassword())
			);
			$entity->setSalutation($data->getSalutation());
			$entity->setFirstName($data->getFirstName());
			$entity->setLastName($data->getLastName());
			$entity->setTitle($data->getTitle());
			$entity->setCompany($data->getCompany());
			$entity->setTaxNumber($data->getTaxNumber());

			$this->entitySaver->save($entity);

			// TODO send activate mail link

			$result->setSuccess(true);
		}
		catch (Exception $ex)
		{
			Log::error($ex);
		}

		return $result;
	}
}