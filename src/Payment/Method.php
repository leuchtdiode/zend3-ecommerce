<?php
namespace Ecommerce\Payment;

use Common\Hydration\ArrayHydratable;
use Ecommerce\Common\IdLabelObject;

class Method implements ArrayHydratable
{
	const PAY_PAL = 'paypal';

	use IdLabelObject;
}