<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Ecommerce\Rest\Action\Customer\Password\Change;

return HttpRouteCreator::create()
	->setRoute('/password')
	->setMayTerminate(false)
	->setChildRoutes(
		[
			'change' => HttpRouteCreator::create()
				->setAction(Change::class)
				->setMethods([ 'PUT' ])
				->getConfig(),
		]
	)
	->getConfig();