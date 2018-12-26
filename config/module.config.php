<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Ecommerce\Payment\Method;
use Ecommerce\Payment\MethodHandler\PayPal\MethodHandler as PayPalMethodHandler;
use Ecommerce\Rest\Action\Plugin\Auth;
use Ecommerce\Rest\Action\Plugin\AuthFactory;
use Ramsey\Uuid\Doctrine\UuidType;

return [

	'ecommerce' => [
		'payment' => [
			'method' => [
				Method::PAY_PAL => [
					'handler' => PayPalMethodHandler::class,
				]
			]
		],
	],

	'router' => [
		'routes' => [
			'ecommerce' => HttpRouteCreator::create()
				->setRoute('/ecommerce')
				->setMayTerminate(false)
				->setChildRoutes(
					[
						'customer' => include 'routes/customer.php',
						'product'  => include 'routes/product.php',
						'cart'     => include 'routes/cart.php',
					]
				)
				->getConfig(),
		],
	],

	'doctrine' => [
		'configuration' => [
			'orm_default' => [
				'types' => [
					UuidType::NAME => UuidType::class,
				],
			],
		],
		'driver'        => [
			'ecommerce_entities' => [
				'class' => AnnotationDriver::class,
				'cache' => 'array',
				'paths' => [ __DIR__ . '/../src/Db' ],
			],
			'orm_default'        => [
				'drivers' => [
					'Ecommerce' => 'ecommerce_entities',
				],
			],
		],
	],

	'service_manager' => [
		'abstract_factories' => [
			DefaultFactory::class,
		],
	],

	'controllers' => [
		'abstract_factories' => [
			DefaultFactory::class,
		],
	],

	'controller_plugins' => [
		'factories' => [
			Auth::class => AuthFactory::class,
		],
		'aliases'   => [
			'auth' => Auth::class,
		],
	],
];