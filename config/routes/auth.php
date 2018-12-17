<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Ecommerce\Rest\Action\Auth\Login;

return HttpRouteCreator::create()
	->setRoute('/auth')
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
				->getConfig()
		]
	)
	->getConfig();