<?php
namespace Ecommerce;

use Common\Router\HttpRouteCreator;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Ramsey\Uuid\Doctrine\UuidType;

return [

	'router' => [
		'routes' => [
			'ecommerce' => HttpRouteCreator::create()
				->setRoute('/ecommerce')
				->setMayTerminate(false)
				->setChildRoutes(
					[
						'auth' => include 'routes/auth.php',
					]
				)
				->getConfig()
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
				'paths' => [__DIR__ . '/../src/Db'],
			],
			'orm_default'          => [
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
			DefaultFactory::class
		],
	],
];