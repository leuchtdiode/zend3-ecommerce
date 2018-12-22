<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Ecommerce\Rest\Action\Customer\Get;
use Ecommerce\Rest\Action\Customer\Login;
use Ecommerce\Rest\Action\Customer\Register;

return HttpRouteCreator::create()
	->setRoute('/customer')
	->setMayTerminate(false)
	->setChildRoutes(
		[
			'login'       => HttpRouteCreator::create()
				->setRoute('/login')
				->setMayTerminate(false)
				->setChildRoutes(
					[
						HttpRouteCreator::create()
							->setAction(Login::class)
							->setMethods([ 'POST' ])
							->getConfig(),
					]
				)
				->getConfig(),
			'register'    => HttpRouteCreator::create()
				->setRoute('/register')
				->setMayTerminate(false)
				->setChildRoutes(
					[
						HttpRouteCreator::create()
							->setAction(Register::class)
							->setMethods([ 'POST' ])
							->getConfig(),
					]
				)
				->getConfig(),
			'single-item' => HttpRouteCreator::create()
				->setRoute('/:id')
				->setConstraints(
					[
						'id' => '.{36}',
					]
				)
				->setMayTerminate(false)
				->setChildRoutes(
					[
						'get'         => HttpRouteCreator::create()
							->setAction(Get::class)
							->setMethods([ 'GET' ])
							->getConfig(),
						'address'     => include 'customer/address.php',
						'transaction' => include 'customer/transaction.php',
					]
				)
				->getConfig(),
		]
	)
	->getConfig();