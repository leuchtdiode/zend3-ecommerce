<?php
namespace Ecommerce\Rest\Action;

use Zend\Mvc\Controller\AbstractRestfulController;

abstract class Base extends AbstractRestfulController
{
	abstract public function executeAction();
}