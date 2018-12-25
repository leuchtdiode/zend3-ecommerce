<?php
namespace Ecommerce\Customer;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Common\IdLabelObject;

class Salutation implements ArrayHydratable
{
	const MALE   = 'male';
	const FEMALE = 'female';

	use IdLabelObject;
}