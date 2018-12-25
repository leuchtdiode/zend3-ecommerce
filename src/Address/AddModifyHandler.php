<?php
namespace Ecommerce\Address;

use Ecommerce\Common\DtoCreatorProvider;
use Ecommerce\Db\Address\Entity;
use Ecommerce\Db\Address\Saver;
use Exception;
use Log\Log;

class AddModifyHandler
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
	 * @param AddModifyData $data
	 * @return AddModifyResult
	 */
	public function addOrModify(AddModifyData $data)
	{
		$result = new AddModifyResult();
		$result->setSuccess(false);

		try
		{
			$entity = $data->getAddress()
				? $data->getAddress()->getEntity()
				: new Entity();
			$entity->setCustomer($data->getCustomer()->getEntity());
			$entity->setZip($data->getZip());
			$entity->setCity($data->getCity());
			$entity->setCountry($data->getCountry());
			$entity->setStreet($data->getStreet());
			$entity->setExtra($data->getExtra());
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