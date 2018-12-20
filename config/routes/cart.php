<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;

return HttpRouteCreator::create()
	->setRoute('/cart')
	->setMayTerminate(false)
	->setChildRoutes(
		[
			'item' => include 'cart/item.php',
		]
	)
	->getConfig();