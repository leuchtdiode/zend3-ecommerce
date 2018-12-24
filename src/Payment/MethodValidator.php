<?php
namespace Ecommerce\Payment;

use Common\Translator;
use Zend\Validator\AbstractValidator;

class MethodValidator extends AbstractValidator
{
	const INVALID = 'invalid';

	/**
	 * @var MethodProvider
	 */
	private $methodProvider;

	/**
	 * @param MethodProvider $methodProvider
	 */
	public function __construct(MethodProvider $methodProvider)
	{
		$this->methodProvider = $methodProvider;

		parent::__construct(
			[
				'messagesTemplates' => [
					self::INVALID => Translator::translate('Ungültige Zahlungsmethode %value%'),
				],
			]
		);
	}

	/**
	 * @param string $value
	 * @return bool
	 */
	public function isValid($value)
	{
		if ($this->methodProvider->byId($value) === null)
		{
			$this->setValue($value);

			$this->error(self::INVALID);

			return false;
		}

		return true;
	}
}