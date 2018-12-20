<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Ecommerce\Rest\Action\Cart\Item\Add;

return HttpRouteCreator::create()
	->setRoute('/item')
	->setMayTerminate(false)
	->setChildRoutes(
		[
			'add' => HttpRouteCreator::create()
				->setMethods(['POST'])
				->setAction(Add::class)
				->getConfig()
		]
	)
	->getConfig();