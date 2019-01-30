<?php
namespace Ecommerce\Rest\Action\Transaction;

use Ecommerce\Rest\Action\Base;
use Ecommerce\Transaction\Invoice\FileSystemPathProvider;
use Ecommerce\Transaction\Provider as TransactionProvider;
use Exception;

class Invoice extends Base
{
	/**
	 * @var TransactionProvider
	 */
	private $transactionProvider;

	/**
	 * @var FileSystemPathProvider
	 */
	private $fileSystemPathProvider;

	/**
	 * @param TransactionProvider $transactionProvider
	 * @param FileSystemPathProvider $fileSystemPathProvider
	 */
	public function __construct(
		TransactionProvider $transactionProvider,
		FileSystemPathProvider $fileSystemPathProvider
	)
	{
		$this->transactionProvider    = $transactionProvider;
		$this->fileSystemPathProvider = $fileSystemPathProvider;
	}

	/**
	 * @throws Exception
	 */
	public function executeAction()
	{
		$response = $this->getResponse();

		$transaction = $this->transactionProvider->byId(
			$this
				->params()
				->fromRoute('transactionId')
		);

		if (!$transaction)
		{
			return $this->notFound();
		}

		$path = $this->fileSystemPathProvider->get($transaction);

		if (!file_exists($path))
		{
			return $this->notFound();
		}

		$pdf = file_get_contents($path);

		$response
			->getHeaders()
			->addHeaders(
				[
					'Content-type' => 'application/pdf;charset=utf-8'
				]
			);

		$response->setContent($pdf);

		return $response;
	}
}