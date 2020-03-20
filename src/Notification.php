<?php

namespace Hallewood\APNS;

use Hallewood\APNS\Notification\ServicePayload;

class Notification {

	protected $servicePayload;

	public function __construct() {
		$this->servicePayload = new ServicePayload;
	}

}
