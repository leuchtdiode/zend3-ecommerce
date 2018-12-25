<?php
namespace Ecommerce\Customer\Auth;

use Common\Translator;
use Ecommerce\Customer\Customer;
use Exception;
use Log\Log;
use Mail\Mail\Mail;
use Mail\Mail\Recipient;
use Mail\Queue\Queue;

class ActivateMailSender
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
	 * @return bool
	 */
	public function send(Customer $customer)
	{
		$config = $this->config['ecommerce']['mail'];

		try
		{
			$mail = new Mail();
			$mail->setLayoutTemplate($config['layout']);
			$mail->setContentTemplate($config['customer']['activate']['template']);
			$mail->setPlaceholderValues(
				ActivateMailSenderPlaceholderValues::create()
					->setCustomer($customer)
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
				Translator::translate($config['customer']['activate']['subject'])
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