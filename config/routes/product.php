<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Ecommerce\Rest\Action\Product\GetList;

return HttpRouteCreator::create()
	->setRoute('/product')
	->setMayTerminate(false)
	->setChildRoutes(
		[
			'get-list' => HttpRouteCreator::create()
				->setMethods(['GET'])
				->setAction(GetList::class)
				->getConfig(),
		]
	)
	->getConfig();