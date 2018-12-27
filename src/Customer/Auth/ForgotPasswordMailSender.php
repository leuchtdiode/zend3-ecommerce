<?php
namespace Ecommerce\Customer\Auth;

use Common\Translator;
use Ecommerce\Customer\Customer;
use Exception;
use Log\Log;
use Mail\Mail\Mail;
use Mail\Mail\Recipient;
use Mail\Queue\Queue;

class ForgotPasswordMailSender
{
	/**
	 * @var array
	 */
	private $config;

	/**
	 * @var Queue
	 */
	private $mailQueue;

	/**
	 * @param array $config
	 * @param Queue $mailQueue
	 */
	public function __construct(array $config, Queue $mailQueue)
	{
		$this->config    = $config;
		$this->mailQueue = $mailQueue;
	}

	/**
	 * @param Customer $customer
	 * @param string $hash
	 * @return bool
	 */
	public function send(Customer $customer, string $hash)
	{
		$config = $this->config['ecommerce']['mail'];

		try
		{
			$mail = new Mail();
			$mail->setLayoutTemplate($config['layout']);
			$mail->setContentTemplate($config['customer']['forgotPassword']['template']);
			$mail->setPlaceholderValues(
				ForgotPasswordMailPlaceholderValues::create()
					->setCustomer($customer)
					->setHash($hash)
			);
			$mail->setFrom(
				Recipient::create(
					$config['from']['email'],
					$config['from']['name']
				)
			);
			$mail->setTo(
				[
					Recipient::create(
						$customer->getEmail(),
						$customer->getName()
					)
				]
			);
			$mail->setSubject(
				Translator::translate($config['customer']['forgotPassword']['subject'])
			);

			$this->mailQueue->add($mail);

			return true;
		}
		catch (Exception $ex)
		{
			Log::error($ex);
		}

		return false;
	}
}