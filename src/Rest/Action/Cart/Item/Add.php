<?php
namespace Ecommerce\Rest\Action\Cart\Item;

use Ecommerce\Cart\Item\AddData as CartItemAddData;
use Ecommerce\Cart\Item\Adder;
use Ecommerce\Rest\Action\Base;
use Ecommerce\Rest\Action\LoginExempt;
use Ecommerce\Rest\Action\Response;
use Exception;
use Zend\View\Model\JsonModel;

class Add extends Base implements LoginExempt
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
	 * @return JsonModel
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

		$addResult = $this->adder->add(
			CartItemAddData::create()
				->setProductId($values->get(AddData::PRODUCT_ID)
					->getValue())
				->setAmount($values->get(AddData::AMOUNT)
					->getValue())
		);

		return Response::is()
			->successful()
			->dispatch();
	}
}