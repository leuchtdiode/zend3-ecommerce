<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Ecommerce\Rest\Action\Customer\Address\Add;
use Ecommerce\Rest\Action\Customer\Address\GetList;

return HttpRouteCreator::create()
	->setRoute('/address')
	->setAction(GetList::class)
	->setMayTerminate(false)
	->setChildRoutes(
		[
			'get-list' => HttpRouteCreator::create()
				->setAction(GetList::class)
				->setMethods(['GET'])
				->getConfig(),
			'add' => HttpRouteCreator::create()
				->setAction(Add::class)
				->setMethods(['POST'])
				->getConfig(),
		]
	)
	->getConfig();