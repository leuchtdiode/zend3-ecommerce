<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Ecommerce\Rest\Action\Customer\Login;

return HttpRouteCreator::create()
	->setRoute('/customer')
	->setMayTerminate(false)
	->setChildRoutes(
		[
			'login' => HttpRouteCreator::create()
				->setRoute('/login')
				->setMayTerminate(false)
				->setChildRoutes(
					[
						HttpRouteCreator::create()
							->setAction(Login::class)
							->setMethods(['POST'])
							->getConfig()
					]
				)
				->getConfig(),
			'single-item' => HttpRouteCreator::create()
				->setRoute('/:id')
				->setConstraints(
					[
						'id' => '.{36}'
					]
				)
				->setMayTerminate(false)
				->setChildRoutes(
					[
						'address' => include 'customer/address.php'
					]
				)
				->getConfig()
		]
	)
	->getConfig();