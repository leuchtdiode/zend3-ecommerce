<?php
namespace Ecommerce\Payment\MethodHandler;

use Zend\Http\Request;

class HandleCallbackData
{
	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @return HandleCallbackData
	 */
	public static function create()
	{
		return new self();
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return HandleCallbackData
	 */
	public function setType(string $type): HandleCallbackData
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return Request
	 */
	public function getRequest(): Request
	{
		return $this->request;
	}

	/**
	 * @param Request $request
	 * @return HandleCallbackData
	 */
	public function setRequest(Request $request): HandleCallbackData
	{
		$this->request = $request;
		return $this;
	}
}