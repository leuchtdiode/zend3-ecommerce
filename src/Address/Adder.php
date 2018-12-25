<?php
namespace Ecommerce\Address;

use Ecommerce\Common\DtoCreatorProvider;
use Ecommerce\Db\Address\Entity;
use Exception;
use Ecommerce\Db\Address\Saver;
use Log\Log;

class Adder
{
	/**
	 * @var Saver
	 */
	private $entitySaver;

	/**
	 * @var DtoCreatorProvider
	 */
	private $dtoCreatorProvider;

	/**
	 * @param Saver $entitySaver
	 * @param DtoCreatorProvider $dtoCreatorProvider
	 */
	public function __construct(Saver $entitySaver, DtoCreatorProvider $dtoCreatorProvider)
	{
		$this->entitySaver        = $entitySaver;
		$this->dtoCreatorProvider = $dtoCreatorProvider;
	}

	/**
	 * @param AddData $data
	 * @return AddResult
	 */
	public function add(AddData $data)
	{
		$result = new AddResult();
		$result->setSuccess(false);

		try
		{
			$entity = new Entity();
			$entity->setCustomer($data->getCustomer()->getEntity());
			$entity->setZip($data->getZip());
			$entity->setCity($data->getCity());
			$entity->setCountry($data->getCountry());
			$entity->setStreet($data->getStreet());
			$entity->setExtra($data->getStreetExtra());
			$entity->setDefaultBilling($data->isDefaultBilling());
			$entity->setDefaultShipping($data->isDefaultShipping());

			// TODO ensure only one default billing and shipping

			$this->entitySaver->save($entity);

			$result->setSuccess(true);
			$result->setAddress(
				$this->dtoCreatorProvider
					->getAddressCreator()
					->byEntity($entity)
			);
		}
		catch (Exception $ex)
		{
			Log::error($ex);
		}

		return $result;
	}
}