<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Ecommerce\Rest\Action\Customer\Address\GetList;

return HttpRouteCreator::create()
	->setRoute('/address')
	->setAction(GetList::class)
	->setMayTerminate(true)
	->setChildRoutes(
		[
			'get-list' => HttpRouteCreator::create()
				->setAction(GetList::class)
				->setMethods(['GET'])
				->getConfig()
		]
	)
	->getConfig();